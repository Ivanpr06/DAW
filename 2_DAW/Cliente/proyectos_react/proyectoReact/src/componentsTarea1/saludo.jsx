import React from 'react';

const Saludo = ({nombre}) => {
    //nombre = 'Iván';
    return (
        <div>
            <h3>Hola {nombre}</h3>
            <p>No se que quieres que te cuente</p>
        </div>
    );
};

export default Saludo;