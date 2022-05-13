const phone = document.getElementById('phone');
      var maskOptions = {
        mask: '(00) 0000-0000'
      };
      var mask = IMask(phone, maskOptions);
      const cpf = document.getElementById('cpf');
      var maskOptions = {
        mask: '000.000.000-00'
      };
      var mask = IMask(cpf, maskOptions);

      document.getElementById("formRegister").addEventListener('submit', event => {
        //Take a fields value using class
        var elements = document.getElementsByClassName("register");
        var formData = new FormData();
        for(var i=0; i<elements.length; i++){
          formData.append(elements[i].name, elements[i].value);
        }
        //Make a pure JS AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
            document.getElementById("formRegister").reset();
            document.getElementById("name").focus();
            window.location.reload();
          }	else if(this.status == 401){
            document.getElementById("txtHint").innerHTML = this.responseText;
            stopsubmit();
          }
        };
        xhttp.open("POST", "././editRegister.php", true);
        xhttp.send(formData);
        event.preventDefault();
        event.stopPropagation();
      });