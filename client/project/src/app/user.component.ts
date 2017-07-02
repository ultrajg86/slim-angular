import { Component, OnInit, ElementRef  } from '@angular/core';

import { UserService } from './service/user.service';

@Component({
  selector: 'user',
  providers: [UserService],
  templateUrl: './html/user.component.html',
  styleUrls: ['./css/user.component.css']
})

export class UserComponent implements OnInit {
  username = 'HelloWorld!';

  constructor(
    private userService: UserService,
    private elementRef: ElementRef 
  ){
  };

  ngOnInit(): void {
    console.log('user component');
  }

  userIdCheck(): void{
    var self = this;
    let name = this.elementRef.nativeElement.querySelector('#username').value;

    this.userService.userId(name).then(obj => {
	let json = JSON.parse(obj);
	if(json.result == true){
		this.username = '<span>사용가능합니다.</span>';
	}else{
		this.username = '<span>사용불가능합니다.</span>';
	}
	
    });

    this.elementRef.nativeElement.querySelector('#username').value = '';
  }

  userLogin(): void{

	  let userid = this.elementRef.nativeElement.querySelector('#userid').value;

	  let userpw = this.elementRef.nativeElement.querySelector('#userpw').value;

	  this.userService.login(userid, userpw).then(obj=>{
		let json = JSON.parse(obj);
		if(json.result == true){
			alert('alal');
		}
	  });
  }

}