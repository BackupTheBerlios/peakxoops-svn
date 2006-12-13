<?php 
/*
 * FCKeditor - The text editor for internet
 * Copyright (C) 2003-2006 Frederico Caldeira Knabben
 * 
 * Licensed under the terms of the GNU Lesser General Public License:
 * 		http://www.opensource.org/licenses/lgpl-license.php
 * 
 * For further information visit:
 * 		http://www.fckeditor.net/
 * 
 * "Support Open Source software. What about a donation today?"
 * 
 * File Name: functions.php
 * 	This is the File Manager Connector for PHP.
 * 
 * File Authors:
 * 		Frederico Caldeira Knabben (fredck@fckeditor.net)
 */

function GetFolders( $currentFolder )
{
	// Array that will hold the folders names.
	$aFolders	= array() ;

	$sServerDir = FCK_UPLOAD_PATH . $currentFolder ;
	$oCurrentFolder = opendir( $sServerDir ) ;

	while( $sFile = readdir( $oCurrentFolder ) )
	{
		if ( $sFile != '.' && $sFile != '..' && is_dir( $sServerDir . $sFile ) )
			$aFolders[] = '<Folder name="' . ConvertToXmlAttribute( $sFile ) . '" />' ;
	}

	closedir( $oCurrentFolder ) ;

	// Open the "Folders" node.
	echo "<Folders>" ;
	
	sort( $aFolders ) ;
	foreach ( $aFolders as $sFolder )
		echo $sFolder ;

	// Close the "Folders" node.
	echo "</Folders>" ;
}


function GetFoldersAndFiles( $currentFolder )
{
	// Map the virtual path to the local server path.
	$sServerDir = FCK_UPLOAD_PATH . $currentFolder ;

	// Arrays that will hold the folders and files names.
	$aFolders	= array() ;
	$aFiles		= array() ;

	$oCurrentFolder = opendir( $sServerDir ) ;

	while ( $sFile = readdir( $oCurrentFolder ) )
	{
		if ( $sFile != '.' && $sFile != '..' )
		{
			if ( is_dir( $sServerDir . $sFile ) )
				$aFolders[] = '<Folder name="' . ConvertToXmlAttribute( $sFile ) . '" />' ;
			else
			{
				$iFileSize = filesize( $sServerDir . $sFile ) ;
				if ( $iFileSize > 0 )
				{
					$iFileSize = round( $iFileSize / 1024 ) ;
					if ( $iFileSize < 1 ) $iFileSize = 1 ;
				}

				$aFiles[] = '<File name="' . ConvertToXmlAttribute( $sFile ) . '" size="' . $iFileSize . '" />' ;
			}
		}
	}

	// Send the folders
	sort( $aFolders ) ;
	echo '<Folders>' ;

	foreach ( $aFolders as $sFolder )
		echo $sFolder ;

	echo '</Folders>' ;

	// Send the files
	rsort( $aFiles ) ;
	echo '<Files>' ;

	foreach ( $aFiles as $sFiles )
		echo $sFiles ;

	echo '</Files>' ;
}


function CreateFolder( $currentFolder )
{
	$sErrorNumber	= '0' ;
	$sErrorMsg		= '' ;

	$sNewFolderName = preg_replace( '/[^0-9a-zA-Z_-]/' , '' , @$_GET['NewFolderName'] ) ;
	if( empty( $sNewFolderName ) ) {
		$sErrorNumber = '102' ;
	} else if( ini_get( 'safe_mode' ) ) {
		$sErrorNumber = '103' ;
		$sErrorMsg = 'Your server runs under safe_mode. Thus, you have to make directories by yourself' ;
	} else {

		// Map the virtual path to the local server path of the current folder.
		$sServerDir = FCK_UPLOAD_PATH . $currentFolder ;

		if( is_writable( $sServerDir ) && ! file_exists( $sServerDir . $sNewFolderName ) ) {
			@mkdir( $sServerDir . $sNewFolderName , 0777 ) ;
		} else {
			$sErrorNumber = '103' ;
		}
	}

	// Create the "Error" node.
	echo '<Error number="' . $sErrorNumber . '" originalDescription="' . ConvertToXmlAttribute( $sErrorMsg ) . '" />' ;
}


function FileUpload( $currentFolder = '/' )
{
	global $fck_allowed_extensions ;

	// Check if the file has been correctly uploaded.
	if ( empty( $_FILES[FCK_UPLOAD_NAME] ) || empty( $_FILES[FCK_UPLOAD_NAME]['tmp_name'] ) || empty( $_FILES[FCK_UPLOAD_NAME]['name'] ) || ! is_uploaded_file( $_FILES[FCK_UPLOAD_NAME]['tmp_name'] ) ) {
		SendResultsHTML( '202' , '' , '' , 'failed to upload' ) ;
	}
	
	// Get extension from the uploaded file
	$extension = strtolower( substr( strrchr( $_FILES[FCK_UPLOAD_NAME]['name'] , '.' ) , 1 ) ) ;
	
	// White list check
	if( ! in_array( $extension , array_keys( $fck_allowed_extensions ) ) ) {
		SendResultsHTML( '1', '', '', 'Invalid file extension. allowed ('.htmlspecialchars(implode('|',$fck_allowed_extensions)).') only' ) ;
	}
	
	// Create new file name (don't use ['name'] other than the extension)
	$new_filename = FCK_FILE_PREFIX . date( 'YmdHis' ) . substr( md5( uniqid( rand() , true ) ) , 16 ) . '.' . $extension ;
	$new_filefullpath = FCK_UPLOAD_PATH.$currentFolder.$new_filename ;
	$new_fileurl = FCK_UPLOAD_URL.$currentFolder.$new_filename ;
	
	// move temporary
	if( ! move_uploaded_file( $_FILES[FCK_UPLOAD_NAME]['tmp_name'] , $new_filefullpath ) ) {
		SendResultsHTML( '202' ) ;
	}
	
	// check the file is valid
	if( $fck_allowed_extensions[ $extension ] ) {
		$check_result = @getimagesize( $new_filefullpath ) ;
		if( ! is_array( @$check_result ) || empty( $check_result['mime'] ) || stristr( $check_result['mime'] , $fck_allowed_extensions[ $extension ] ) === false ) {
			@unlink( $new_filefullpath ) ;
			SendResultsHTML( '202', '', '', 'File extension does not match the file contents' ) ;
		}
	}

	// success and exit
	SendResultsHTML( 0 , $new_fileurl , $new_filename ) ;
}


function ConvertToXmlAttribute( $value )
{
	return utf8_encode( htmlspecialchars( $value , ENT_QUOTES ) ) ;
}


function SetXmlHeaders()
{
	// Prevent the browser from caching the result.
	// Date in the past
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT') ;
	// always modified
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT') ;
	// HTTP/1.1
	header('Cache-Control: no-store, no-cache, must-revalidate') ;
	header('Cache-Control: post-check=0, pre-check=0', false) ;
	// HTTP/1.0
	header('Pragma: no-cache') ;

	// Set the response format.
	header( 'Content-Type:text/xml; charset=utf-8' ) ;
}


function CreateXmlHeader( $command, $currentFolder )
{
	SetXmlHeaders() ;
	
	// Create the XML document header.
	echo '<?xml version="1.0" encoding="utf-8" ?>' ;

	// Create the main "Connector" node.
	echo '<Connector command="' . $command . '" resourceType="Image">' ;
	
	// Add the current folder node.
	echo '<CurrentFolder path="' . ConvertToXmlAttribute( $currentFolder ) . '" url="' . ConvertToXmlAttribute( FCK_UPLOAD_URL . $currentFolder ) . '" />' ;
}


function CreateXmlFooter()
{
	echo '</Connector>' ;
}


// return error by XML (for browser AJAX)
function SendErrorXML( $number , $fileUrl = '' , $fileName = '' ,  $text = '' )
{
	SetXmlHeaders() ;
	
	// Create the XML document header
	echo '<?xml version="1.0" encoding="utf-8" ?>' ;
	
	echo '<Connector><Error number="' . $number . '" text="' . htmlspecialchars( $text ) . '" /></Connector>' ;
	
	exit ;
}


// return results by HTML (for upload AHAH)
function SendResultsHTML( $number , $fileUrl = '' , $fileName = '' , $text = '' )
{
	if( defined( 'FCK_IS_BROWSER_CONNECTOR' ) ) {
		echo '<script type="text/javascript">' ;
		echo 'window.parent.frames["frmUpload"].OnUploadCompleted(' . $number . ',"' . str_replace( '"', '\\"', $fileName ) . '") ;' ;
		echo '</script>' ;
	} else {
		echo '<script type="text/javascript">' ;
		echo 'window.parent.OnUploadCompleted(' . $number . ',"' . str_replace( '"', '\\"', $fileUrl ) . '","' . str_replace( '"', '\\"', $fileName ) . '", "' . str_replace( '"', '\\"', $text ) . '") ;' ;
		echo '</script>' ;
	}
	exit ;
}


// Error Wrapper
function SendError( $number , $fileUrl = '' , $fileName = '' ,  $text = '' )
{
	if( defined( 'FCK_IS_BROWSER_CONNECTOR' ) ) {
		SendErrorXML( $number , $fileUrl , $fileName ,  $text ) ;
	} else {
		SendResultsHTML( $number , $fileUrl , $fileName , $text ) ;
	}
}

?>