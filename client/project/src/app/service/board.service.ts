import { Injectable } from '@angular/core';
import { Headers, Http, Response }       from '@angular/http';

import { Observable }     from 'rxjs/Observable';

import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/map';

@Injectable()
export class BoardService {

  private headers = new Headers({'Content-Type': 'application/json'});
  private baseUrl = 'http://localhost:8888/api';

  constructor(private http: Http) {}

  public userId(id: string): Promise<string>{

    return this.http.get(this.baseUrl + '/' + id)
	     .toPromise()
	     .then(response => response.json().name);

  }



}
