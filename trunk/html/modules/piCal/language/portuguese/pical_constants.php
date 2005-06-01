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


// format for date()  see http://jp.php.net/date
define('_PICAL_DTFMT_TIME','H:i') ;

// set your locale
define('_PICAL_LOCALE','en_US') ;
// format for strftime()  see http://jp.php.net/strftime
define('_PICAL_STRFFMT_DATE','%d %b %Y (%a)') ;
define('_PICAL_STRFFMT_DATE_FOR_BLOCK','%d %b') ;
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

define('_PICAL_ICON_LIST','Vista por lista') ;
define('_PICAL_ICON_DAILY','Vista diária') ;
define('_PICAL_ICON_WEEKLY','Vista semanal') ;
define('_PICAL_ICON_MONTHLY','Vista mensal') ;
define('_PICAL_ICON_YEARLY','Vista anual') ;

define('_PICAL_MB_SHOWALLCAT','Todas as Categorias') ;

define('_PICAL_MB_LINKTODAY','Hoje') ;
define('_PICAL_MB_NOSUBJECT','(Sem assunto)') ;

define('_PICAL_MB_PREV_DATE','Amanhã') ;
define('_PICAL_MB_NEXT_DATE','Ontem') ;
define('_PICAL_MB_PREV_WEEK','Semana anterior') ;
define('_PICAL_MB_NEXT_WEEK','Próxima Semana') ;
define('_PICAL_MB_PREV_MONTH','Mês anterior') ;
define('_PICAL_MB_NEXT_MONTH','Próximo Mês') ;
define('_PICAL_MB_PREV_YEAR','Ano anterior') ;
define('_PICAL_MB_NEXT_YEAR','Próximo Ano') ;

define('_PICAL_MB_NOEVENT','Sem eventos') ;
define('_PICAL_MB_ADDEVENT','Adicionar um evento') ;
define('_PICAL_MB_CONTINUING','(continua)') ;
define('_PICAL_MB_RESTEVENT_PRE','mais') ;
define('_PICAL_MB_RESTEVENT_SUF','item(s)') ;
define('_PICAL_MB_TIMESEPARATOR','--') ;

define('_PICAL_MB_ALLDAY_EVENT','Evento de todo o dia') ;
define('_PICAL_MB_LONG_EVENT','Mostrar como barra') ;
define('_PICAL_MB_LONG_SPECIALDAY','Comemorações etc.') ;

define('_PICAL_MB_PUBLIC','Público') ;
define('_PICAL_MB_PRIVATE','Privado') ;
define('_PICAL_MB_PRIVATETARGET',' entre %s') ;

define('_PICAL_MB_LINK_TO_RRULE1ST','Pular para primeiro Evento ') ;
define('_PICAL_MB_RRULE1ST','Este é o primeiro Evento') ;

define('_PICAL_MB_EVENT_NOTREGISTER','Não Registrado') ;
define('_PICAL_MB_EVENT_ADMITTED','Admitido') ;
define('_PICAL_MB_EVENT_NEEDADMIT','Esperando admissão') ;

define('_PICAL_MB_TITLE_EVENTINFO','Agenda') ;
define('_PICAL_MB_SUBTITLE_EVENTDETAIL','Vista detalhada') ;
define('_PICAL_MB_SUBTITLE_EVENTEDIT','Vista de edição') ;

define('_PICAL_MB_HOUR_SUF',':') ;
define('_PICAL_MB_MINUTE_SUF','') ;

define('_PICAL_MB_ORDER_ASC','ascendente') ;
define('_PICAL_MB_ORDER_DESC','descendente') ;
define('_PICAL_MB_SORTBY','Ordenar por:') ;
define('_PICAL_MB_CURSORTEDBY','Eventos atualmente ordenados por:') ;

define("_PICAL_MB_LABEL_CHECKEDITEMS","Os eventos assinalados são:");
define("_PICAL_MB_LABEL_OUTPUTICS","para ser exportados no iCalendar");

define("_PICAL_MB_ICALSELECTPLATFORM","Selecionar plataforma");

define('_PICAL_TH_SUMMARY','Título') ;
define('_PICAL_TH_STARTDATETIME','Hora e data de início') ;
define('_PICAL_TH_ENDDATETIME','Hora e data de fim') ;
define('_PICAL_TH_ALLDAYOPTIONS','Opcões do dia todo') ;
define('_PICAL_TH_LOCATION','Localização') ;
define('_PICAL_TH_CONTACT','Contato') ;
define('_PICAL_TH_CATEGORIES','Categorias') ;
define('_PICAL_TH_SUBMITTER','Remetente') ;
define('_PICAL_TH_CLASS','Classe') ;
define('_PICAL_TH_DESCRIPTION','Descrição') ;
define('_PICAL_TH_RRULE','Repetir as regras') ;
define('_PICAL_TH_ADMISSIONSTATUS','Estado') ;
define('_PICAL_TH_LASTMODIFIED','Ultima modificação') ;

define('_PICAL_NTC_MONTHLYBYMONTHDAY','(Número de entradas)') ;
define('_PICAL_NTC_EXTRACTLIMIT','** Apenas %s eventos são extraídos como máximo') ;
define('_PICAL_NTC_NUMBEROFNEEDADMIT','(%s itens precisam ser admitidos)') ;

define('_PICAL_OPT_PRIVATEMYSELF','Apenas eu') ;
define('_PICAL_OPT_PRIVATEGROUP','grupo %s') ;
define('_PICAL_OPT_PRIVATEINVALID','(grupo inválido)') ;

define('_PICAL_MB_OP_AFTER','Depois') ;
define('_PICAL_MB_OP_BEFORE','Antes') ;
define('_PICAL_MB_OP_ON','Em') ;
define('_PICAL_MB_OP_ALL','Todos') ;

define('_PICAL_CNFM_SAVEAS_YN','Você têm certeza de salvar como outra entrada') ;
define('_PICAL_CNFM_DELETE_YN','Você têm certeza de excluir esta entrada?') ;

define('_PICAL_ERR_INVALID_EVENT_ID','Error: ID do evento não encontrada') ;
define('_PICAL_ERR_NOPERM_TO_SHOW',"Error: Não têm permiso de ver o calendario") ;
define('_PICAL_ERR_NOPERM_TO_OUTPUTICS',"Error: Não têm permiso de editar o calendario") ;
define('_PICAL_ERR_LACKINDISPITEM','O item %s está vazio.<br />Clique o botão de voltar do seu navegador') ;

define('_PICAL_BTN_JUMP','Pular') ;
define('_PICAL_BTN_NEWINSERTED','Novo item') ;
define('_PICAL_BTN_SUBMITCHANGES',' Troque o item! ') ;
define('_PICAL_BTN_SAVEAS','Salvar como') ;
define('_PICAL_BTN_DELETE','Excluí-lo') ;
define('_PICAL_BTN_EDITEVENT','Editá-lo') ;
define('_PICAL_BTN_RESET','Limpar') ;
define('_PICAL_BTN_OUTPUTICS_WIN','iCalendario(Win)') ;
define('_PICAL_BTN_OUTPUTICS_MAC','iCalendario(Mac)') ;
define('_PICAL_BTN_PRINT','Imprimir') ;
define("_PICAL_BTN_IMPORT","Importar!");
define("_PICAL_BTN_UPLOAD","Atualizar!");
define("_PICAL_BTN_EXPORT","Exportar!");
define("_PICAL_BTN_EXTRACT","Extraer");
define("_PICAL_BTN_ADMIT","Admitir");
define("_PICAL_BTN_MOVE","Mover");
define("_PICAL_BTN_COPY","Copiar");

define('_PICAL_RR_EVERYDAY','Cada dia') ;
define('_PICAL_RR_EVERYWEEK','Cada semana') ;
define('_PICAL_RR_EVERYMONTH','Cada mês') ;
define('_PICAL_RR_EVERYYEAR','Cada ano') ;
define('_PICAL_RR_FREQDAILY','Diario') ;
define('_PICAL_RR_FREQWEEKLY','Semanal') ;
define('_PICAL_RR_FREQMONTHLY','Mensal') ;
define('_PICAL_RR_FREQYEARLY','Anual') ;
define('_PICAL_RR_FREQDAILY_PRE','Cada') ;
define('_PICAL_RR_FREQWEEKLY_PRE','Cada') ;
define('_PICAL_RR_FREQMONTHLY_PRE','Cada') ;
define('_PICAL_RR_FREQYEARLY_PRE','Cada') ;
define('_PICAL_RR_FREQDAILY_SUF','dia(s)') ;
define('_PICAL_RR_FREQWEEKLY_SUF','semana(s)') ;
define('_PICAL_RR_FREQMONTHLY_SUF','mês(es)') ;
define('_PICAL_RR_FREQYEARLY_SUF','ano(s)') ;
define('_PICAL_RR_PERDAY','cada %s dias') ;
define('_PICAL_RR_PERWEEK','cada %s semanas') ;
define('_PICAL_RR_PERMONTH','cada %s meses') ;
define('_PICAL_RR_PERYEAR','cada %s anos') ;
define('_PICAL_RR_COUNT','<br />%s veces') ;
define('_PICAL_RR_UNTIL','<br />até %s') ;
define('_PICAL_RR_R_NORRULE','Não se repete') ;
define('_PICAL_RR_R_YESRRULE','Repetição') ;
define('_PICAL_RR_OR','or') ;
define('_PICAL_RR_S_NOTSELECTED','-não selecionado-') ;
define('_PICAL_RR_S_SAMEASBDATE','Igual que a data de início') ;
define('_PICAL_RR_R_NOCOUNTUNTIL','Nenhuma condição de final') ;
define('_PICAL_RR_R_USECOUNT_PRE','repetir') ;
define('_PICAL_RR_R_USECOUNT_SUF','vezes') ;
define('_PICAL_RR_R_USEUNTIL','até') ;


}

?>