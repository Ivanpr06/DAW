import React, {useState} from 'react';


const Ej3 = () => {

    const [texto, setTexto] = useState('');
    const [clikado, setClikado] = useState(false);

    return (
        <section>
            <input type="text" onChange={(e) => setTexto(e.target.value)}/>
            <p>{texto}</p>
            <button onClick={() => setClikado(!clikado)} style={{ backgroundColor: clikado ? 'green' : '' }}>{clikado ? 'Hola que pasa' : 'Boton de Cambio'}</button>
        </section>
    );
}

export default Ej3;