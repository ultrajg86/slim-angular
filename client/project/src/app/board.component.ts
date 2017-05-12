import { Component, OnInit, ElementRef  } from '@angular/core';

import { BoardService } from './service/board.service';

@Component({
  selector: 'board',
  providers: [BoardService],
  templateUrl: './html/board.component.html',
  styleUrls: ['./css/board.component.css']
})

export class BoardComponent implements OnInit {

  constructor(
    private boardService: BoardService,
    private elementRef: ElementRef 
  ){
  };

  ngOnInit(): void {
    console.log('board component');
    this.boardList();
  }

  boardList():void{
	console.log('boardList Action');
  }

  boardWrite():void{
	console.log('boardWrite Action');
  }

  boardView():void{
	console.log('boardView Action');
  }

}