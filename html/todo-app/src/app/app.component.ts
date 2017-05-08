import { Component } from '@angular/core';
import {Todo} from './todo';
import { TodoDataService } from './todo-data.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
  providers: [ TodoDataService ]
})

export class AppComponent{

  newTodo: Todo = new Todo();
  private todoDataService: TodoDataService;

  constructor(todoDataService: TodoDataService) {
	this.todoDataService = todoDataService;
  }

  toggleTodoComplete(todo): void{
	this.todoDataService.toggleTodoComplete(todo);
  }
   

}
