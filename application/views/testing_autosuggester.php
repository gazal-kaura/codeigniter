<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  function bindAutoSuggst(){
      $( "#tags" ).autocomplete({
      source: "http://127.0.0.1/search.php",
      minLength : 2,
      select : function(event,ui){
          alert(ui.item.id);
      }

    });
  }
  bindAutoSuggst();
  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags">
</div>
 <script type="text/javascript" src="/var/www/html/autocomplete.js"></script>
 
</body>
</html>