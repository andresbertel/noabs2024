/* Detener en este fotograma
La línea de tiempo de Animate se detendrá/pausará en el fotograma en el que se inserte este código.
También se puede utilizar para detener/pausar la línea de tiempo de clips de película.
*/

stop();

/* Hacer clic para ir al fotograma y detener
Al hacer clic en la instancia del símbolo especificado, la cabeza lectora se mueve hasta el fotograma especificado en la línea de tiempo y detiene la película.
Se puede utilizar en la línea de tiempo principal o en líneas de tiempo de clips de película.

Instrucciones:
1. Reemplace el número 5 del siguiente código por el número de fotograma hasta el que quiere que se mueva la cabeza lectora cuando se haga clic en la instancia del símbolo.
*/

rp16.addEventListener(MouseEvent.CLICK, fl_ClickToGoToAndStopAtFrame_544);

function fl_ClickToGoToAndStopAtFrame_544(event:MouseEvent):void
{
	respuestas[15]="1";
	gotoAndStop(1517);
}

/* Hacer clic para ir al fotograma y detener
Al hacer clic en la instancia del símbolo especificado, la cabeza lectora se mueve hasta el fotograma especificado en la línea de tiempo y detiene la película.
Se puede utilizar en la línea de tiempo principal o en líneas de tiempo de clips de película.

Instrucciones:
1. Reemplace el número 5 del siguiente código por el número de fotograma hasta el que quiere que se mueva la cabeza lectora cuando se haga clic en la instancia del símbolo.
*/

rn16.addEventListener(MouseEvent.CLICK, fl_ClickToGoToAndStopAtFrame_554);

function fl_ClickToGoToAndStopAtFrame_554(event:MouseEvent):void
{
	respuestas[15]="2";
	gotoAndStop(1519);
}

/* Hacer clic para ir al fotograma y detener
Al hacer clic en la instancia del símbolo especificado, la cabeza lectora se mueve hasta el fotograma especificado en la línea de tiempo y detiene la película.
Se puede utilizar en la línea de tiempo principal o en líneas de tiempo de clips de película.

Instrucciones:
1. Reemplace el número 5 del siguiente código por el número de fotograma hasta el que quiere que se mueva la cabeza lectora cuando se haga clic en la instancia del símbolo.
*/

rng16.addEventListener(MouseEvent.CLICK, fl_ClickToGoToAndStopAtFrame_564);

function fl_ClickToGoToAndStopAtFrame_564(event:MouseEvent):void
{
	respuestas[15]="3";
	gotoAndStop(1518);
}
