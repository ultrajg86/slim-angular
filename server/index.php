<?php

/*
header( 'Access-Control-Allow-Origin: *' );
header( 'Access-Control-Allow-Methods: GET, POST, OPTIONS' );
header( "Access-Control-Allow-Headers: X-AMZ-META-TOKEN-ID, X-AMZ-META-TOKEN-SECRET, Content-Type, Accept" );
*/
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;
/*
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
*/
$app->get('/', function (Request $request, Response $response) {
	$response->getBody()->write('Hello World');
	return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    //$response->getBody()->write("Hello, $name");
	$result = array(
		'name'=>$name
	);
//    return $response;
return json_encode($result);
});

$app->get('/testheroes', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

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