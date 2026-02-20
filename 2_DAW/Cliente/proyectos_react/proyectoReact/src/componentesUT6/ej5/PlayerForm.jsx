import { useState, useEffect } from 'react';

const PlayerForm = ({ addPlayer, updatePlayer, editingPlayer, setEditingPlayer, currentPlayers }) => {

    const initialState = { nombre: '', dorsal: '', posicion: 'Receptor', altura: '' };
    const [formData, setFormData] = useState(initialState);
    const [errors, setErrors] = useState({}); // Para guardar mensajes de error

    useEffect(() => {
        if (editingPlayer) {
            setFormData(editingPlayer);
        } else {
            setFormData(initialState);
        }
        setErrors({});
    }, [editingPlayer]);

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        const newErrors = {};

        if (formData.nombre.length < 3) newErrors.nombre = "Mínimo 3 caracteres";

        const h = Number(formData.altura);
        if (h < 140 || h > 230) newErrors.altura = "Entre 140 y 230 cm";

        const d = Number(formData.dorsal);
        if (d < 1 || d > 99) newErrors.dorsal = "Entre 1 y 99";

        const existe = currentPlayers.some(p => p.dorsal == d && p.id !== formData.id);
        if (existe) newErrors.dorsal = "Dorsal repetido";

        // 2. Decisión
        if (Object.keys(newErrors).length > 0) {
            setErrors(newErrors); // Mostrar errores
        } else {
            // Todo OK
            if (editingPlayer) {
                updatePlayer(formData);
            } else {
                addPlayer(formData);
                setFormData(initialState);
            }
            setErrors({});
        }
    };

    return (
        <div className="form-container">
            <h3>{editingPlayer ? "Editar Jugador" : "Alta de Jugador"}</h3>
            <form onSubmit={handleSubmit}>

                <div className="form-group">
                    <label>Nombre:</label>
                    <input type="text" name="nombre" value={formData.nombre} onChange={handleChange} />
                    {errors.nombre && <span className="error-msg">{errors.nombre}</span>}
                </div>

                <div className="form-group">
                    <label>Dorsal:</label>
                    <input type="number" name="dorsal" value={formData.dorsal} onChange={handleChange} />
                    {errors.dorsal && <span className="error-msg">{errors.dorsal}</span>}
                </div>

                <div className="form-group">
                    <label>Posición:</label>
                    <select name="posicion" value={formData.posicion} onChange={handleChange}>
                        <option>Colocador</option>
                        <option>Opuesto</option>
                        <option>Receptor</option>
                        <option>Central</option>
                        <option>Líbero</option>
                    </select>
                </div>

                <div className="form-group">
                    <label>Altura (cm):</label>
                    <input type="number" name="altura" value={formData.altura} onChange={handleChange} />
                    {errors.altura && <span className="error-msg">{errors.altura}</span>}
                </div>

                <button type="submit">{editingPlayer ? "Guardar" : "Añadir"}</button>

                {editingPlayer && (
                    <button type="button" onClick={() => setEditingPlayer(null)} style={{marginLeft: '10px'}}>
                        Cancelar
                    </button>
                )}
            </form>
        </div>
    );
};

export default PlayerForm;