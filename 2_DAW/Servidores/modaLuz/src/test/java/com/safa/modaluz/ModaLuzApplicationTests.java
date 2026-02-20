package com.safa.modaluz;

import com.safa.modaluz.modelos.Cliente;
import com.safa.modaluz.repositorios.IClienteRepository;
import org.junit.jupiter.api.Test;
import org.springframework.boot.test.context.SpringBootTest;

import java.util.List;

@SpringBootTest
class ModaLuzApplicationTests {

    private IClienteRepository clienteRepository;

    @Test
    void consularClientes() {
        List<Cliente> clientes = clienteRepository.findAll();
        for (Cliente cliente : clientes) {
            System.out.println(cliente);
        }
    }

    @Test
    void crearCliente() {
        Cliente cliente = new Cliente();
        cliente.setNombre("Manolo");
        cliente.setCorreo("manolo@gmail.com");
        cliente.setContrasena("123456");

        clienteRepository.save(cliente);
    }

    @Test
    void editCliente() {
        Cliente cliente = clienteRepository.findById(1).orElse(null);

        if(cliente != null) {
            cliente.setNombre("Juanito");
        }

        clienteRepository.save(cliente);
    }

    @Test
    void eliminarCliente() {
        clienteRepository.deleteById(1);
    }

}