import { Injectable } from '@angular/core';
import { Headers, Http, Response }       from '@angular/http';

import { Observable }     from 'rxjs/Observable';

import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/map';

@Injectable()
export class UserService {

  private headers = new Headers({'Content-Type': 'application/json'});
  private baseUrl = 'http://localhost:8888/api';

  constructor(private http: Http) {}

  public userId(id: string): Promise<string>{

    return this.http.get(this.baseUrl + '/check/' + id)
	     .toPromise()
	     .then(response => response.text());

  }

  public login(id: string, pw: string): Promise<string>{
	let data = {'userid': id, 'userpwd': pw};
	return this.http.post(this.baseUrl + '/login', JSON.stringify(data), {headers: this.headers})
		.toPromise()
	     .then(response => response.text());
  }


}
