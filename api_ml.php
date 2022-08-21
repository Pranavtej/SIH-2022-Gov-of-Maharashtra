<html>
    <body>
        <form action="#" method="post">
            <input id="id1" type="number"><br><br>
            <input id="id2" type="number"><br><br>
            <input id="id3" type="number"><br><br>
            <h5 id="answer"></h5>
            <input type="button" value="submit" onclick="generate();">
        </form>
    </body>
    <script>
        function generate() {
				let a = document.getElementById("id1").value;
                alert(a);
                let b = document.getElementById("id2").value;
                alert(b);
                let c = document.getElementById("id3").value;
                alert(c);
				var xmlhttp=new XMLHttpRequest();
  				xmlhttp.onreadystatechange=function() {
    				if (this.readyState==4 && this.status==200) {
						console.log(this.responseText);
      					document.getElementById("answer").innerHTML=this.responseText;
    				}
 				}
  				xmlhttp.open("GET","https://stdpyml.herokuapp.com/?m1="+a+"&m2=1&m3="+b+"&m4=1&m5="+c+"&m6=1",true);
  				xmlhttp.send();
			}
    </script>
</html>