import React from 'react';
import { useState } from 'react';

const Contador = () => {

    const [numero, setNumero] = useState(0);

    return (
        <div>
            <button onClick={() => {setNumero(numero + 1); console.log('Has sumado')}}>
                Añadir
            </button>
            <button onClick={() => {setNumero(numero - 1); console.log('Has restado')}}>
                Restar
            </button>
            <button onClick={() => {setNumero(0); console.log('Has reseteado')}}>
                Resetear
            </button>
            <p>{numero}</p>
        </div>
    );
};

export default Contador;