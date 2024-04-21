stop();

import flash.net.*;
import flash.events.*;


//var PATH:String = "url.txt";
//var url:URLRequest = new URLRequest(PATH);


var url:URLRequest=new URLRequest("/enviardatos");
var variables:URLVariables=new URLVariables();
var loader:URLLoader=new URLLoader();



function carga() {
	variables.r1=respuestas[0];
	variables.r2=respuestas[1];
	variables.r3=respuestas[2];
	variables.r4=respuestas[3];
	variables.r5=respuestas[4];
	variables.r6=respuestas[5];
	variables.r7=respuestas[6];
	variables.r8=respuestas[7];
	variables.r9=respuestas[8];
	variables.r10=respuestas[9];
	variables.r11=respuestas[10];
	variables.r12=respuestas[11];
	variables.r13=respuestas[12];
	variables.r14=respuestas[13];
	variables.r15=respuestas[14];
	variables.r16=respuestas[15];
	variables.r17=respuestas[16];
	url.data=variables;
	url.method=URLRequestMethod.POST;
	sendToURL(url);
	trace(variables);
	
	
}

/* Hacer clic para ir al fotograma y detener
Al hacer clic en la instancia del símbolo especificado, la cabeza lectora se mueve hasta el fotograma especificado en la línea de tiempo y detiene la película.
Se puede utilizar en la línea de tiempo principal o en líneas de tiempo de clips de película.

Instrucciones:
1. Reemplace el número 5 del siguiente código por el número de fotograma hasta el que quiere que se mueva la cabeza lectora cuando se haga clic en la instancia del símbolo.
*/

rp17.addEventListener(MouseEvent.CLICK, fl_ClickToGoToAndStopAtFrame_66);

function fl_ClickToGoToAndStopAtFrame_66(event:MouseEvent):void
{
	respuestas[16]="1";
	carga();
	gotoAndStop(1633);
}


/* Hacer clic para ir al fotograma y reproducir
Al hacer clic en la instancia del símbolo especificado, la cabeza lectora se mueve hasta el fotograma especificado en la línea de tiempo y prosigue la reproducción desde dicho fotograma.
Se puede utilizar en la línea de tiempo principal o en líneas de tiempo de clips de película.

Instrucciones:
1. Reemplace el número 5 del siguiente código por el número de fotograma hasta el que quiere que se mueva la cabeza lectora cuando se haga clic en la instancia del símbolo.
*/

rn17.addEventListener(MouseEvent.CLICK, fl_ClickToGoToAndPlayFromFrame_26);

function fl_ClickToGoToAndPlayFromFrame_26(event:MouseEvent):void
{
	respuestas[16]="2";
	carga();
	gotoAndPlay(1635);
}

/* Hacer clic para ir al fotograma y detener
Al hacer clic en la instancia del símbolo especificado, la cabeza lectora se mueve hasta el fotograma especificado en la línea de tiempo y detiene la película.
Se puede utilizar en la línea de tiempo principal o en líneas de tiempo de clips de película.

Instrucciones:
1. Reemplace el número 5 del siguiente código por el número de fotograma hasta el que quiere que se mueva la cabeza lectora cuando se haga clic en la instancia del símbolo.
*/

rng17.addEventListener(MouseEvent.CLICK, fl_ClickToGoToAndStopAtFrame_68);

function fl_ClickToGoToAndStopAtFrame_68(event:MouseEvent):void
{
	respuestas[16]="3";
	carga();
	gotoAndStop(1634);
}
