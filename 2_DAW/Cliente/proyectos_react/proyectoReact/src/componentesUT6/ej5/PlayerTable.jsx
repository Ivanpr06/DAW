const PlayerTable = ({ players, onEdit, onDelete, onSort }) => {
    return (
        <div>
            <div style={{ marginBottom: '10px' }}>
                <button onClick={() => onSort('asc')}>Dorsal ↑</button>
                <button onClick={() => onSort('desc')}>Dorsal ↓</button>
            </div>

            <table>
                <thead>
                <tr>
                    <th>Dorsal</th>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Altura</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                {players.map((p) => (
                    <tr key={p.id} className={`fila-${p.posicion.toLowerCase()}`}>
                        <td>{p.dorsal}</td>
                        <td>{p.nombre}</td>
                        <td>{p.posicion}</td>
                        <td>{p.altura} cm</td>
                        <td>
                            <button onClick={() => onEdit(p)}>Editar</button>
                            <button onClick={() => onDelete(p.id)} style={{ color: 'red', marginLeft: '5px' }}>
                                Eliminar
                            </button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
};

export default PlayerTable;