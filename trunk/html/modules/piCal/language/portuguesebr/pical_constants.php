<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( 'PICAL_CNST_LOADED' ) ) {



// Appended by Xoops Language Checker -GIJOE- in 2005-05-17 17:34:01
define('_PICAL_BTN_DELETE_ONE','Remove just one');

// Appended by Xoops Language Checker -GIJOE- in 2005-05-03 05:31:14
define('_PICAL_JS_CALENDAR','calendar-en.js');
define('_PICAL_JSFMT_YMDN','%d %B %Y (%A)');
define('_PICAL_DTFMT_MINUTE','i');
define('_PICAL_FMT_YMDN','%3$s %2$s %1$s %4$s');
define('_PICAL_FMT_DHI','%1$s %2$s:%3$s');
define('_PICAL_FMT_HI','%1$s:%2$s');
define('_PICAL_TH_TIMEZONE','Time Zone');

define( 'PICAL_CNST_LOADED' , 1 ) ;
 //* Brazilian Portuguese Translation by Marcelo Yuji Himoro <www.yuji.eu.org> *//

// format for date()  see http://jp.php.net/date
define('_PICAL_DTFMT_TIME','H:i') ;

// set your locale
define('_PICAL_LOCALE','pt_BR') ;
// format for strftime()  see http://jp.php.net/strftime
define('_PICAL_STRFFMT_DATE','%A, %d de %B de %Y') ;
define('_PICAL_STRFFMT_DATE_FOR_BLOCK','%d/%m') ;
define('_PICAL_STRFFMT_TIME','%H:%M') ;

// definition of orders     Y:year  M:month  W:week  D:day  O:operand
define('_PICAL_FMT_MD','%2$s %1$s') ;
define('_PICAL_FMT_YMD','%3$s %2$s %1$s') ;
define('_PICAL_FMT_YMDO','%4$s%3$s%2$s%1$s') ;
define('_PICAL_FMT_YMW','%3$s %2$s %1$s') ;
define('_PICAL_FMT_YW','WEEK%2$s %1$s') ;
define('_PICAL_FMT_YEAR_MONTH','%2$s %1$s') ;
define('_PICAL_FMT_YEAR','<font size="-1">ANO </font>%s') ;
define('_PICAL_FMT_WEEKNO','SEMANA %s') ;

define('_PICAL_ICON_LIST','Mostrar lista de eventos') ;
define('_PICAL_ICON_DAILY','Mostrar diariamente') ;
define('_PICAL_ICON_WEEKLY','Mostrar semanalmente') ;
define('_PICAL_ICON_MONTHLY','Mostrar mensalmente') ;
define('_PICAL_ICON_YEARLY','Mostrar anualmente') ;

define('_PICAL_MB_SHOWALLCAT','Mostrar todas as categorias') ;

define('_PICAL_MB_LINKTODAY','[Hoje]') ;
define('_PICAL_MB_NOSUBJECT','(Sem assunto)') ;

define('_PICAL_MB_PREV_DATE','Ontem') ;
define('_PICAL_MB_NEXT_DATE','Amanhã') ;
define('_PICAL_MB_PREV_WEEK','Semana anterior') ;
define('_PICAL_MB_NEXT_WEEK','Semana seguinte') ;
define('_PICAL_MB_PREV_MONTH','Mês anterior') ;
define('_PICAL_MB_NEXT_MONTH','Mês seguinte') ;
define('_PICAL_MB_PREV_YEAR','Ano anterior') ;
define('_PICAL_MB_NEXT_YEAR','Ano seguinte') ;

define('_PICAL_MB_NOEVENT','Não há eventos') ;
define('_PICAL_MB_ADDEVENT','Adicionar um evento') ;
define('_PICAL_MB_CONTINUING','(Continua)') ;
define('_PICAL_MB_RESTEVENT_PRE','mais') ;
define('_PICAL_MB_RESTEVENT_SUF','item(ns)') ;
define('_PICAL_MB_TIMESEPARATOR','~') ;

define('_PICAL_MB_ALLDAY_EVENT','Evento para o dia inteiro') ;
define('_PICAL_MB_LONG_EVENT','Mostrar como barra') ;
define('_PICAL_MB_LONG_SPECIALDAY','Datas importantes e feriados') ;

define('_PICAL_MB_PUBLIC','Público') ;
define('_PICAL_MB_PRIVATE','Particular') ;
define('_PICAL_MB_PRIVATETARGET',' entre %s') ;

define('_PICAL_MB_LINK_TO_RRULE1ST','Ir para o 1º evento ') ;
define('_PICAL_MB_RRULE1ST','1º evento') ;

define('_PICAL_MB_EVENT_NOTREGISTER','Não registrado') ;
define('_PICAL_MB_EVENT_ADMITTED','Aprovado') ;
define('_PICAL_MB_EVENT_NEEDADMIT','Pendente de aprovação') ;

define('_PICAL_MB_TITLE_EVENTINFO','Agenda') ;
define('_PICAL_MB_SUBTITLE_EVENTDETAIL','Mais detalhes') ;
define('_PICAL_MB_SUBTITLE_EVENTEDIT','Editar') ;

define('_PICAL_MB_HOUR_SUF',':') ;
define('_PICAL_MB_MINUTE_SUF','') ;

define('_PICAL_MB_ORDER_ASC','Crescente') ;
define('_PICAL_MB_ORDER_DESC','Decrescente') ;
define('_PICAL_MB_SORTBY','Ordenado por:') ;
define('_PICAL_MB_CURSORTEDBY','Atualmente ordenados por:') ;

define("_PICAL_MB_LABEL_CHECKEDITEMS","");
define("_PICAL_MB_LABEL_OUTPUTICS","");

define("_PICAL_MB_ICALSELECTPLATFORM","Escolha um formato para exportação");

define('_PICAL_TH_SUMMARY','Título') ;
define('_PICAL_TH_STARTDATETIME','Data e hora de início') ;
define('_PICAL_TH_ENDDATETIME','Data e hora de término') ;
define('_PICAL_TH_ALLDAYOPTIONS','Opções do dia') ;
define('_PICAL_TH_LOCATION','Local') ;
define('_PICAL_TH_CONTACT','Endereço de contato') ;
define('_PICAL_TH_CATEGORIES','Categorias') ;
define('_PICAL_TH_SUBMITTER','Autor') ;
define('_PICAL_TH_CLASS','Tipo') ;
define('_PICAL_TH_DESCRIPTION','Descrição') ;
define('_PICAL_TH_RRULE','Repetir') ;
define('_PICAL_TH_ADMISSIONSTATUS','Estado') ;
define('_PICAL_TH_LASTMODIFIED','Última modificação') ;

define('_PICAL_NTC_MONTHLYBYMONTHDAY','(Especificar datas)') ;
define('_PICAL_NTC_EXTRACTLIMIT','* Apenas %s eventos serão exportados.') ;
define('_PICAL_NTC_NUMBEROFNEEDADMIT','(%s itens pendentes de aprovação)') ;

define('_PICAL_OPT_PRIVATEMYSELF','Apenas eu') ;
define('_PICAL_OPT_PRIVATEGROUP','Grupo %s') ;
define('_PICAL_OPT_PRIVATEINVALID','(grupo inválido)') ;

define('_PICAL_MB_OP_AFTER','Depois') ;
define('_PICAL_MB_OP_BEFORE','Antes') ;
define('_PICAL_MB_OP_ON','Em') ;
define('_PICAL_MB_OP_ALL','Todos') ;

define('_PICAL_CNFM_SAVEAS_YN','Você deseja realmente salvá-lo como outro registro?') ;
define('_PICAL_CNFM_DELETE_YN','Você deseja realmente apagar este registro?') ;

define('_PICAL_ERR_INVALID_EVENT_ID','ERRO: o nº ID não foi encontrado.') ;
define('_PICAL_ERR_NOPERM_TO_SHOW',"ERRO: você não tem permissão de acesso.") ;
define('_PICAL_ERR_NOPERM_TO_OUTPUTICS',"ERRO: você não tem permissão para exportar para o iCalendar.") ;
define('_PICAL_ERR_LACKINDISPITEM','O item %s está em branco.<br />Use o botão "Voltar" do seu browser!') ;

define('_PICAL_BTN_JUMP','Pular') ;
define('_PICAL_BTN_NEWINSERTED','Novo evento') ;
define('_PICAL_BTN_SUBMITCHANGES',' Alterar ') ;
define('_PICAL_BTN_SAVEAS','Salvar como') ;
define('_PICAL_BTN_DELETE','Apagar') ;
define('_PICAL_BTN_EDITEVENT','Editar') ;
define('_PICAL_BTN_RESET','Limpar') ;
define('_PICAL_BTN_OUTPUTICS_WIN','iCalendario(Win)') ;
define('_PICAL_BTN_OUTPUTICS_MAC','iCalendario(Mac)') ;
define('_PICAL_BTN_PRINT','Imprimir') ;
define("_PICAL_BTN_IMPORT","Importar");
define("_PICAL_BTN_UPLOAD","Atualizar");
define("_PICAL_BTN_EXPORT","Exportar para iCalendar");
define("_PICAL_BTN_EXTRACT","Extrair");
define("_PICAL_BTN_ADMIT","Aprovar");
define("_PICAL_BTN_MOVE","Mover");
define("_PICAL_BTN_COPY","Copiar");

define('_PICAL_RR_EVERYDAY','Todo dia') ;
define('_PICAL_RR_EVERYWEEK','Toda semana') ;
define('_PICAL_RR_EVERYMONTH','Todo mês') ;
define('_PICAL_RR_EVERYYEAR','Todo ano') ;
define('_PICAL_RR_FREQDAILY','Diário') ;
define('_PICAL_RR_FREQWEEKLY','Semanal') ;
define('_PICAL_RR_FREQMONTHLY','Mensal') ;
define('_PICAL_RR_FREQYEARLY','Anual') ;
define('_PICAL_RR_FREQDAILY_PRE','A cada ') ;
define('_PICAL_RR_FREQWEEKLY_PRE','A cada ') ;
define('_PICAL_RR_FREQMONTHLY_PRE','A cada ') ;
define('_PICAL_RR_FREQYEARLY_PRE','A cada ') ;
define('_PICAL_RR_FREQDAILY_SUF','dia(s)') ;
define('_PICAL_RR_FREQWEEKLY_SUF','semana(s)') ;
define('_PICAL_RR_FREQMONTHLY_SUF','mês(es)') ;
define('_PICAL_RR_FREQYEARLY_SUF','Ano(s)') ;
define('_PICAL_RR_PERDAY','cada %s dias') ;
define('_PICAL_RR_PERWEEK','cada %s semanas') ;
define('_PICAL_RR_PERMONTH','cada %s meses') ;
define('_PICAL_RR_PERYEAR','cada %s anos') ;
define('_PICAL_RR_COUNT','<br />%s vezes') ;
define('_PICAL_RR_UNTIL','<br />até %s') ;
define('_PICAL_RR_R_NORRULE','Não repetir') ;
define('_PICAL_RR_R_YESRRULE','Repetir') ;
define('_PICAL_RR_OR','ou') ;
define('_PICAL_RR_S_NOTSELECTED','-não selecionado-') ;
define('_PICAL_RR_S_SAMEASBDATE','A mesma data que a de início') ;
define('_PICAL_RR_R_NOCOUNTUNTIL','Nenhuma condição de término') ;
define('_PICAL_RR_R_USECOUNT_PRE','repetir') ;
define('_PICAL_RR_R_USECOUNT_SUF','vezes') ;
define('_PICAL_RR_R_USEUNTIL','até') ;


}

?>