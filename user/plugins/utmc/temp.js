  /**
    if param is array I have to
      for each param
        push str += prefix + par_k + par_val into urls array

      also I have to check if urls array is empty while appending the str and if it is not,
      I append every urls instance with the remaining stuff
  */


  urls: function() {
    var str = this.baseUrl;
    var params = [
      { utm_source: this.utm_source_bulk },
      { utm_media: this.utm_media_bulk },
      { utm_campaign: this.utm_campaign_bulk },
      { utm_content: this.utm_content_bulk },
      { utm_term: this.utm_term_bulk },
    ];
    var urls = [];
    params.forEach(function(param, i) {
      var prefix = (i == 0) ? '?' : '&';
      var par_k = encodeURIComponent(Object.keys(param)[0]) + '=';
      var par_val = Object.values(param)[0];
      if (par_val !== '' && typeof par_val !== 'undefined' && par_val !== null) {
        if ( par_val instanceof Array ) {
          console.log(par_val, 'is array');
          // par_val.forEach(function(item, i) {
          // 	str += prefix + par_k + par_val;
          // 	urls.push(str);
          // });
        } else {
          par_val = encodeURIComponent(par_val);
          // modify array
          if (urls.length > 0) {
            urls.forEach(function(url, i) {
              this[i] += prefix + par_k + par_val;
            }, urls)
          // modify string
          } else {
            str += prefix + par_k + par_val;
          }
        }
      }
    });
    return urls;
},
