import React, {useState} from 'react';

const PequenaAplicacion = () => {
    const [nombre, setNombre] = useState('');
    const [alumnos, setAlumnos] = useState([]);

    const anadirAlumno = (e) => {
        e.preventDefault();
        setAlumnos([...alumnos,nombre])
        setNombre('');
    };

    const eliminarAlumno = (index) => {
        setAlumnos(alumnos.filter((_, i) => i !== index));
    };

    return (
        <div>
            <label>
                <input type="text" value={nombre}
                       onChange={(e) => {setNombre(e.target.value)}}
                />
            </label>
            <br></br>
            <br></br>
            <button type="submit" onClick={anadirAlumno}>Enviar</button>
            <p>
                {alumnos.map((nombre, index) => (
                    <>
                        <div style={{display: 'flex', justifyContent: 'center', alignItems: 'center'}}>
                            <div key={index}>{nombre}</div>
                            <button type="submit" onClick={() => eliminarAlumno(index)}>Eliminar</button>
                        </div>
                    </>
                ))}
            </p>
        </div>
    );
};

export default PequenaAplicacion;