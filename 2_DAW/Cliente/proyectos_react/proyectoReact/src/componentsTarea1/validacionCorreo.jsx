import React, {useState} from 'react';


const ValidacionCorreo = () => {
    const [nombre, setNombre] = useState('');
    const [correo, setCorreo] = useState('');

    const verificarDatos = (e) => {
        e.preventDefault();

        const nombreRegex = /^[a-zA-Z]+/;
        if (!nombreRegex.test(nombre)) {
            console.log("Nombre no válido");
        } else {
            console.log("Nombre valido");
        }

        const emailRegex = /^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(correo)) {
            console.log("Email no válido");
        } else {
            console.log("Email valido");
        }
    }

    return (
        <div>
            <form>
                <label>
                    Nombre:
                    <input type="text" value={nombre} required={true}
                           onChange={(e) => {setNombre(e.target.value)}}
                    />
                </label>
                <br></br>
                <br></br>
                <label>
                    Correo:
                    <input type="email" value={correo} required={true}
                           onChange={(e) => {setCorreo(e.target.value)}}
                    />
                </label>
                <br></br>
                <br></br>
                <button type="submit" onClick={verificarDatos}>Enviar</button>
            </form>
        </div>
    );
};

export default ValidacionCorreo;