
function validarLogin(){
        const formulario = document.getElementById('formul');
        const inputs = document.querySelectorAll('#formul input');
        
        const expresiones = {
            password: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{7,40}$/, //La contraseña debe tener como minimo 7 digitos, entre ellos: un numero y una Mayuscula.
            correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
        }
        
        const campos = {
            password: false,
            correo: false,
        }
        
        const validarFormulario = (e) => {
            switch (e.target.name) {
                case "password":
                    validarCampo(expresiones.password, e.target, 'password');
                break;
                case "correo":
                    validarCampo(expresiones.correo, e.target, 'correo');
                break;
            } e.preventDefault();
        }
        
        const validarCampo = (expresion, input, campo) => {
            if(expresion.test(input.value)){
                document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
                document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
                document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
                document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
                document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
                campos[campo] = true;
            } else {
                document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
                document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
                document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
                document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
                document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
                campos[campo] = false;
            }
        }
       
        inputs.forEach((input) => {
            input.addEventListener('keyup', validarFormulario);
            input.addEventListener('blur', validarFormulario);
        });
        
       
            if(campos.password && campos.correo){
                formulario.reset();
                
                document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
                setTimeout(() => {
                    document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
                }, 1000);
        
                document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
                    icono.classList.remove('formulario__grupo-correcto');
                });

            } else {
                document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
                setTimeout(()=>{
                  document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
                }, 1000);
            };
                return true;
        }