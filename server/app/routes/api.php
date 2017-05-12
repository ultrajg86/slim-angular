<?php

$app->group('/api', function(){

	$this->get('/check/{userid}', 'UserController:checkId');	//중복체크

	$this->post('/login', 'UserController:login');	//로그인

	$this->post('/logout', 'UserController:logout');	//로그아웃 - 토큰값 전달(토큰삭제)

	$this->post('/join', 'UserController:join');	//회원가입

	//로그인 이후 모든 내역은 토큰값을 비교하여 토큰 검사
	$this->group('/user/{token}', function(){	//로그인시 token을 생성하여 전달된 값을 보내야함

		$this->get('/{userid}', 'UserController:info');	//회원정보보기

		$this->put('/modify', 'UserController:modify');	//정보수정

	});

	//게시판
	$this->group('/board/{token}', function(){	//회원전용

		$this->get('/list[/{searchword}]', 'BoardController:lists');	//목록	=> 페이지는 ? 물음표로

		$this->get('/view/{idx:[0-9]+}', 'BoardController:views');	//보기

		$this->delete('/delete', 'BoardController:delete');	//삭제

		$this->put('/modify', 'BoardController:modify');	//수정

	});

});

/*
1. 로그인 후 로그아웃은 필수로한다는 조건
2. token은 나중에 처리해야함...ㅠㅠㅠㅠ
3. 
*/