import { useState } from 'react';
import PlayerForm from './PlayerForm';
import PlayerTable from './PlayerTable';
import './team.css';

const TeamApp = () => {
    const [players, setPlayers] = useState([
        { id: 1, nombre: 'Haikyuu', dorsal: 10, posicion: 'Receptor', altura: 170 },
        { id: 2, nombre: 'Kageyama', dorsal: 9, posicion: 'Colocador', altura: 180 }
    ]);

    const [editingPlayer, setEditingPlayer] = useState(null);
    const [showModal, setShowModal] = useState(false);
    const [idToDelete, setIdToDelete] = useState(null);

    const addPlayer = (newPlayer) => {
        setPlayers([...players, { ...newPlayer, id: Date.now() }]);
    };

    const updatePlayer = (updatedPlayer) => {
        setPlayers(players.map(p => (p.id === updatedPlayer.id ? updatedPlayer : p)));
        setEditingPlayer(null);
    };

    const requestDelete = (id) => {
        setIdToDelete(id);
        setShowModal(true);
    };

    const confirmDelete = () => {
        setPlayers(players.filter(p => p.id !== idToDelete));
        setShowModal(false);
        setIdToDelete(null);
    };

    const sortPlayers = (order) => {
        const sorted = [...players].sort((a, b) => {
            return order === 'asc' ? a.dorsal - b.dorsal : b.dorsal - a.dorsal;
        });
        setPlayers(sorted);
    };

    return (
        <div className="app-container">
            <PlayerForm
                addPlayer={addPlayer}
                updatePlayer={updatePlayer}
                editingPlayer={editingPlayer}
                setEditingPlayer={setEditingPlayer}
                currentPlayers={players}
            />

            <PlayerTable
                players={players}
                onEdit={setEditingPlayer}
                onDelete={requestDelete}
                onSort={sortPlayers}
            />

            {showModal && (
                <div className="modal-overlay">
                    <div className="modal-content">
                        <h3>¿Eliminar jugador?</h3>
                        <p>Esta acción no se puede deshacer.</p>
                        <button className="btn-danger" onClick={confirmDelete}>Sí, Eliminar</button>
                        <button className="btn-cancel" onClick={() => setShowModal(false)}>Cancelar</button>
                    </div>
                </div>
            )}
        </div>
    );
};

export default TeamApp;