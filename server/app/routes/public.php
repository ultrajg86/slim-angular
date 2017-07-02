<?php

/*
	1. 웹접근용으로, 리턴은 json으로 보내되 세션 등 서버에서 할수있는 작업만 함
*/
$app->group('', function () {

	$this->get('/', function($request, $response, $args){
		//return $response->withRedirect('http://localhost:4200');
		return $this->view->render($response, 'index.html', array('key'=>'value', 'key1'=>'value1'));
	});

	$this->get('/check/{userid}', 'UserController:check');	//중복체크

	$this->post('/login', 'UserController:login');	//로그인

	$this->post('/logout', 'UserController:logout');	//로그아웃 - 토큰값 전달(토큰삭제)

	$this->post('/join', 'UserController:join');	//회원가입

	$this->group('/user', function(){	//로그인시 token을 생성하여 전달된 값을 보내야함

		$this->get('/{userid}', 'UserController:info');	//회원정보보기

		$this->put('/modify', 'UserController:modify');	//정보수정

	});

	//게시판
	$this->group('/board', function(){	//회원전용

		$this->get('', 'BoardController:lists');

		$this->get('/list[/{searchword}]', 'BoardController:lists');	//목록	=> 페이지는 ? 물음표로

		$this->get('/view/{idx:[0-9]+}', 'BoardController:views');	//보기

		$this->delete('/delete', 'BoardController:delete');	//삭제

		$this->put('/modify', 'BoardController:modify');	//수정

	});

})->add($webMw);
