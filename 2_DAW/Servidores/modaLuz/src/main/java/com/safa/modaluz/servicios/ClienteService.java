package com.safa.modaluz.servicios;

import com.safa.modaluz.dto.ClienteCrearDTO;
import com.safa.modaluz.modelos.Cliente;
import com.safa.modaluz.repositorios.IClienteRepository;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class ClienteService {

    private IClienteRepository clienteRepository;

    // Buscar Todos
    public List<Cliente> bucarTodosClientes() {
        return clienteRepository.findAll();
    }

    // Buscar por Id
    public Cliente buscarClientePorId(Integer id) {
        return clienteRepository.findById(id).orElse(null);
    }

    // Editar
    public void editarCliente(Integer id, Cliente detallesCliente) {
        Cliente clienteExistente = clienteRepository.findById(id).orElse(null);

        clienteExistente.setNombre(detallesCliente.getNombre());
        clienteExistente.setCorreo(detallesCliente.getCorreo());
        clienteExistente.setContrasena(detallesCliente.getContrasena());

        clienteRepository.save(clienteExistente);
    }

    // Crear
    public void crearCliente(ClienteCrearDTO cliente) {
        Cliente nuevoCliente = new Cliente();

        nuevoCliente.setNombre(cliente.getNombre());
        nuevoCliente.setCorreo(cliente.getCorreo());
        nuevoCliente.setContrasena(cliente.getContrasena());

        clienteRepository.save(nuevoCliente);
    }

    // Eliminar
    public void eliminarCliente(Integer id) {
        clienteRepository.deleteById(id);
    }
}