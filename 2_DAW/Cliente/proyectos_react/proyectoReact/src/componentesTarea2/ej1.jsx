import React from "react";
import "./ej1.css";

const PanelAcciones = () => {
    const [historial, setHistorial] = React.useState([]);
    const [valorInput, setValorInput] = React.useState("");

    const registrarAccion = (e, nombreElemento) => {
        let info = "";

        if (e.type === "input") {
            info = e.target.value;
        } else if (e.type === "keydown") {
            info = e.key;
        } else if (e.type === "click" || e.type === "mouseover") {
            info = `Coordenadas: ${e.clientX}, ${e.clientY}`;
        }

        const nuevaAccion = {
            tipo: e.type,
            elemento: nombreElemento,
            info: info,
        };

        setHistorial((prev) => [...prev, nuevaAccion]);
    };

    return (
        <div className="panel-acciones-container">
            <button onClick={(e) => registrarAccion(e, "Botón")}>Botón</button>

            <input
                type="text" value={valorInput}
                onChange={(e) => setValorInput(e.target.value)}
                onInput={(e) => registrarAccion(e, "Input")}
                onKeyDown={(e) => registrarAccion(e, "Input")}/>

            <a onClick={(e) => {e.preventDefault(); registrarAccion(e, "Enlace");}}
                onMouseOver={(e) => registrarAccion(e, "Enlace")}>
                Enlace</a>

            <div className="zona-interactiva" onMouseOver={(e) => registrarAccion(e, "Zona interactiva")}></div>

            <h3>Registro de acciones:</h3>
            <div className="panel-registro">
                {historial.map((accion, index) => (
                    <p key={index}><strong>{accion.tipo}</strong> - {accion.elemento} - {accion.info}</p>
                ))}
            </div>
        </div>
    );
};

export default PanelAcciones;