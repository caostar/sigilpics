import { Promise } from 'es6-promise'
import 'whatwg-fetch'
import _ from 'lodash'
import {config} from '../../package.json';

class FetchAPI  {
  constructor(...args) {}

  go (path) {
    return new Promise((resolve, reject) => {

      let url = DEBUG != true ? config.apiURL + path : config.apiURLDEV + path;

      try {
          fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Basic Z2FtYTpuZWNrZnVjaw=='
            }
          })
          .then(response => {
            if (response.status >= 200 && response.status < 300) {
              return response
            } else {
              console.log(response)
              let error = new Error(response.statusText)
              error.response = response
              error.status = response.status
              throw error
            }
          })
          .then(response => {
            let json = response.json()
            resolve(json, response)
          })
          .catch(error => {
            console.log(error);
            switch(error.status) {
              case 0:
                console.log('Opaque response from mode:"no-cors" ')
                break
              case 400:
              case 401:
              case 403:
                console.log('Unauthorized. Sorry!')
                break
              case 500:
              case 501:
              case 502:
              case 503:
                console.log('The system is broken. Sorry!')
                break
              default:
                console.log('Unexpected error. Sorry!')
            }
            
            reject(error)
          })
      } catch (e) {
        console.log("try error: ", e)
        reject(e)
      }
    })
  }
}

export default new FetchAPI();
