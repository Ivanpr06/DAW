import React from 'react';

const ListaAlumnos = () => {
    let lista = ['Paco', 'Manolo', 'Juan'];

    return (
        <div>
            {lista.map((nombre, index) => (
                <div key={index}>{nombre}</div>
            ))}
        </div>
    );
};

export default ListaAlumnos;