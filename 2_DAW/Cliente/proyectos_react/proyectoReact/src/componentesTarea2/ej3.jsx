import React, {useState} from 'react';
import './ej3.css'

const Ej3 = () => {

    const [nombre, setNombre] = useState('');
    const [edad, setEdad] = useState('');
    const [correo, setCorreo] = useState('');

    const [errorNombre, setErrorNombre] = useState('');
    const [errorEdad, setErrorEdad] = useState('');
    const [errorCorreo, setErrorCorreo] = useState('');

    const [enviado, setEnviado] = useState(false);

    const nombreRegex = /^([A-Z][a-z]+|de|del|la|las|los)(\s([A-Z][a-z]+|de|del|la|las|los))*$/;
    const edadRegex = /^(?:[1-9][0-9]?|0)$/;
    const correoRegex = /^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/;

    const validarNombre = () => {
        if (!nombre) {
            setErrorNombre("El campo es obligatorio");
            return false;
        }
        if (!nombreRegex.test(nombre)) {
            setErrorNombre("Nombre inválido");
            return false;
        }
        setErrorNombre('');
        return true;
    };

    const validarEdad = () => {
        if (!edad) {
            setErrorEdad("El campo es obligatorio");
            return false;
        }
        if (!edadRegex.test(edad)) {
            setErrorEdad("Edad inválida");
            return false;
        }
        setErrorEdad('');
        return true;
    };

    const validarCorreo = () => {
        if (!correo) {
            setErrorCorreo("El campo es obligatorio");
            return false;
        }
        if (!correoRegex.test(correo)) {
            setErrorCorreo("Correo inválido");
            return false;
        }
        setErrorCorreo('');
        return true;
    };

    const enviarFormulario = (e) => {
        e.preventDefault();
        const nombreValido = validarNombre();
        const edadValida = validarEdad();
        const correoValido = validarCorreo();

        if (nombreValido && edadValida && correoValido) {
            setEnviado(true);
        } else {
            setEnviado(false);
        }
    };

    return (
        <div>
            <form onSubmit={enviarFormulario}>
                <div>
                    <label> Nombre :
                        <input type={'text'} value={nombre} onChange={(e) => {setNombre(e.target.value)}} onBlur={validarNombre}></input>
                    </label>
                    <p>{errorNombre}</p>
                </div>

                <div>
                    <label> Edad :
                        <input type={'text'} value={edad} onChange={(e) => {setEdad(e.target.value)}} onBlur={validarEdad}></input>
                    </label>
                    <p>{errorEdad}</p>
                </div>

                <div>
                    <label> Correo :
                        <input type={'text'} onChange={(e) => {setCorreo(e.target.value)}} onBlur={validarCorreo}></input>
                    </label>
                    <p>{errorCorreo}</p>
                </div>

                <div>
                    <button type={"submit"} onClick={enviarFormulario}>Enviar</button>
                </div>
            </form>

            {enviado && (
                <div className="resumen">
                    <p>Tu nombre es: {nombre}</p>
                    <p>Tu edad es: {edad}</p>
                    <p>Tu correo es: {correo}</p>
                </div>
            )}
        </div>
    );
};

export default Ej3;