<?php

header( 'Access-Control-Allow-Origin: *' );
/*
header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );
header( "Access-Control-Allow-Headers: X-AMZ-META-TOKEN-ID, X-AMZ-META-TOKEN-SECRET, Content-Type, Accept" );
*/

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$settings = require './app/settings.php';

$app = new \Slim\App($settings);

require './app/constants.php';

require './app/dependencies.php';

require './app/middleware.php';

require './app/route.php';

$app->run();

/*
<html>
	<head>
		<script type="text/javascript">
			function loadXMLDoc(dname){
                if (window.XMLHttpRequest){
                    xhttp=new XMLHttpRequest();
                }else{
                    xhttp=new ActiveXObject("Microsoft.XMLDOM");
                }

                xhttp.open("GET",dname,false);
                xhttp.send();
                return xhttp.responseXML;
            }

		</script>
	</head>
	<body>

		<div id="output"></div>

		<script type="text/javascript">
		
			xmlDoc=loadXMLDoc("http://localhost:8888/book.xml"); 
				
			objXml = xmlDoc.getElementsByTagName("channel")[0].getElementsByTagName("item");
			ouput = document.getElementById("output");
			for(i=0; i<objXml.length; i++){
				output.innerHTML = output.innerHTML + objXml[i].getElementsByTagName("description")[0].textContent + "   <hr/>";
				console.log(objXml[i]);
			}

		</script>

	</body>
</html>
*/