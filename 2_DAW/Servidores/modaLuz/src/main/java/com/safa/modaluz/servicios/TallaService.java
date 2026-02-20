package com.safa.modaluz.servicios;

import com.safa.modaluz.dto.TallaCrearDTO;
import com.safa.modaluz.modelos.Talla;
import com.safa.modaluz.repositorios.ITallaRepository;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class TallaService {

    private ITallaRepository tallaRepository;

    // Buscar Todos
    public List<Talla> bucarTodosTallas() {
        return tallaRepository.findAll();
    }

    // Buscar por Id
    public Talla buscarTallaPorId(Integer id) {
        return tallaRepository.findById(id).orElse(null);
    }

    // Editar
    public void editarTalla(Integer id, Talla detallesTalla) {
        Talla tallaExistente = tallaRepository.findById(id).orElse(null);

        tallaExistente.setDescripcion(detallesTalla.getDescripcion());

        tallaRepository.save(tallaExistente);
    }

    // Crear
    public void crearTalla(TallaCrearDTO talla) {
        Talla nuevaTalla = new Talla();

        nuevaTalla.setDescripcion(talla.getDescripcion());

        tallaRepository.save(nuevaTalla);
    }

    // Eliminar
    public void eliminarTalla(Integer id) {
        tallaRepository.deleteById(id);
    }
}
