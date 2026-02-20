package com.safa.modaluz.servicios;

import com.safa.modaluz.dto.InventarioCrearDTO;
import com.safa.modaluz.modelos.Cliente;
import com.safa.modaluz.modelos.Inventario;
import com.safa.modaluz.repositorios.IInventarioRepository;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class InventarioService {

    private IInventarioRepository inventarioRepository;

    // Buscar Todos
    public List<Inventario> bucarTodosInventarios() {
        return inventarioRepository.findAll();
    }

    // Buscar por Id
    public Inventario buscarInventarioPorId(Integer id) {
        return inventarioRepository.findById(id).orElse(null);
    }

    // Editar
    public void editarInventario(Integer id, Inventario detallesInventario) {
        Inventario inventarioExistente = inventarioRepository.findById(id).orElse(null);

        inventarioExistente.setCantidad(detallesInventario.getCantidad());
        inventarioExistente.setTalla(detallesInventario.getTalla());
        inventarioExistente.setProducto(detallesInventario.getProducto());

        inventarioRepository.save(inventarioExistente);
    }

    // Crear
    public void crearInventario(InventarioCrearDTO inventario) {
        Inventario nuevoInventario = new Inventario();

        nuevoInventario.setCantidad(inventario.getCantidad());
        nuevoInventario.setTalla(inventario.getTalla());
        nuevoInventario.setProducto(inventario.getProducto());

        inventarioRepository.save(nuevoInventario);
    }

    // Eliminar
    public void eliminarInventario(Integer id) {
        inventarioRepository.deleteById(id);
    }
}
