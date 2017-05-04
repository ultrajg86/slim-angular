import { Injectable }    from '@angular/core';
import { Headers, Http, Response } from '@angular/http';

import { Observable } from 'rxjs/Observable';

import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/map';

import { Hero } from './hero';

@Injectable()
export class HeroService {

  private headers = new Headers({'Content-Type': 'application/json'});
  private heroesUrl = 'api/heroes';  // URL to web api

  private people;
  private result;

  constructor(private http: Http) { }

/*	
  getTest(): Observable<Hero[]>{
	return this.http.get('http://localhost:8888/heroes', {headers: this.headers}).map(response: Response) => <Hero[]> response.json());
  }
*/
  getHeroes(): Promise<Hero[]> {

/*
    var Obj = this.http.get('127.0.0.1:8888/heroes', {headers: this.headers})
		.subscribe(
			res => {
				var data = res.json().data;
				for(var i=0; i<data.length; i++){
					console.log(data[i].id + ' : ' + data[i].name);
				}
				
			},
			error=>{
				console.error(error.status + ':' + error.statusText);
			}
		);


	this.http.get('http://localhost:8888/testheroes', {headers: this.headers})
		.subscribe(
			res => this.result = JSON.stringify(res.json()),
			err => console.error(err),
			() => console.log('done')
		);
*/		

this.http.get('/heroes').map((response: Response) => response.text())
.subscribe(
data => console.log('S'),
error => console.log('Could not load datas')
);


    return this.http.get(this.heroesUrl)
               .toPromise()
               .then(response => response.json().data as Hero[])
               .catch(this.handleError);
  }

private extractData(res: Response) {
        let body = res.json();
        return body.data || { };
    }

  getHero(id: number): Promise<Hero> {
    const url = `${this.heroesUrl}/${id}`;
    return this.http.get(url)
      .toPromise()
      .then(response => response.json().data as Hero)
      .catch(this.handleError);
  }

  delete(id: number): Promise<void> {
    const url = `${this.heroesUrl}/${id}`;
    return this.http.delete(url, {headers: this.headers})
      .toPromise()
      .then(() => null)
      .catch(this.handleError);
  }

  create(name: string): Promise<Hero> {
    return this.http
      .post(this.heroesUrl, JSON.stringify({name: name}), {headers: this.headers})
      .toPromise()
      .then(res => res.json().data as Hero)
      .catch(this.handleError);
  }

  update(hero: Hero): Promise<Hero> {
    const url = `${this.heroesUrl}/${hero.id}`;
    return this.http
      .put(url, JSON.stringify(hero), {headers: this.headers})
      .toPromise()
      .then(() => hero)
      .catch(this.handleError);
  }

  private handleError(error: any): Promise<any> {
    console.error('An error occurred', error); // for demo purposes only
    return Promise.reject(error.message || error);
  }

  private handleOError(error: any){
	Observable.of(false);
	return Observable.of(false);
  }

}

