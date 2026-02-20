import React from 'react';
import {useState} from "react";

const FormularioSimple = () => {
    const [nombre, setNombre] = useState('');
    const [nombre2, setNombre2] = useState('');

    const enviar = (e) => {
        e.preventDefault();
        setNombre2(nombre);
    };

    return (
        <div>
            <label>
                <input type="text" value={nombre}
                    onChange={(e) => setNombre(e.target.value)}
                />
            </label>
            <p>{nombre}</p>
            <button type="submit" onClick={enviar}>Enviar</button>
            <p>{nombre2}</p>
        </div>

    );
};

export default FormularioSimple;
