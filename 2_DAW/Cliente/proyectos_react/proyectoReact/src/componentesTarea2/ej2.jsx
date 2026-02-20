import React from 'react';

const Ej2 = () => {

    const [checked, setChecked] = React.useState(false);

    const mensaje = (texto) =>{
        console.log(texto);
    }

    return (
        <>
            <section>
                <div onClick={() => mensaje("Div Contenedor clickado")}>
                    <div onClick={()=> mensaje("Div Subcontenedor clickado")}>
                        <button onClick={(e) => {mensaje("Boton clickado");
                        if(checked){
                            e.stopPropagation();
                        }}}>Boton</button>
                    </div>
                </div>
            </section>
            <br></br>
            <label>
                <input type="checkbox" onChange={(e) => setChecked(e.target.checked)}></input>
            </label>
        </>
    );
};

export default Ej2;