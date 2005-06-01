#!/bin/sh
if [ -z "$1" ]; then
	echo 'usage: mk_templates.sh modulesnumber (0,1,2,3...)'
else

cp -a blocks/xhld_block_rss.html blocks/xhld$1_block_rss.html
cp -a blocks/xhld_block_mixed.html blocks/xhld$1_block_mixed.html
cp -a xhld_block.html xhld$1_block.html
cp -a xhld_feed.html xhld$1_feed.html
cp -a xhld_index.html xhld$1_index.html

fi
