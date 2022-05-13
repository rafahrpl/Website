const type = document.getElementById("type");
      type.addEventListener('click', event => {
        document.getElementById("change").placeholder = "Digite seu " + type.options[type.selectedIndex].text;
      });
      type.addEventListener('change', event => {
        document.getElementById("change").value = "";
      });
      document.getElementById("formRegister").addEventListener('keyup', event => {
        //Take a fields value
        var keyword = type.options[type.selectedIndex].value;
        var change = document.getElementById("change").value;
        //Make a pure JS AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("responseTable").innerHTML = this.responseText;
            //window.location.reload();
          }	else if(this.status == 401){
            document.getElementById("responseTable").innerHTML = this.responseText;
            stopsubmit();
          }
        };
        xhttp.open("GET", "././searchRegister.php?keyword="+keyword+"&value="+change, true);
        xhttp.send();
        //event.preventDefault();
        //event.stopPropagation();
      });

      function deletert(email){
        if(confirm('Deseja deletar o cadastro?')){
            var formData = new FormData();
            formData.append('email', email);
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function(){
                if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
                    document.getElementById("txtHint").innerHTML = this.responseText;
                } else if(xmlHttp.status == 401){
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            }
            xmlHttp.open("POST", "././deleteRegister.php");
            xmlHttp.send(formData);
        }
      }
