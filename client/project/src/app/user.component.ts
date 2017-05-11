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

   this.userService.userId(name).then(obj => this.username = obj);

    this.elementRef.nativeElement.querySelector('#username').value = '';
  }

}