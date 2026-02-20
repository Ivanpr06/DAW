package com.safa.modaluz.controladores;

import com.safa.modaluz.dto.ClienteCrearDTO;
import com.safa.modaluz.modelos.Cliente;
import com.safa.modaluz.servicios.ClienteService;
import lombok.AllArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
@RequestMapping("/cliente")
public class ClienteController {

    @Autowired
    private ClienteService clienteService;

    @GetMapping("/all")
    public List<Cliente> obtenerClientes(){
        return clienteService.bucarTodosClientes();
    }

    @GetMapping("/{id}")
    public Cliente obtenerClientePorId(@PathVariable int id){
        return clienteService.buscarClientePorId(id);
    }

    @PostMapping("/post")
    public void crearCliente(@RequestBody ClienteCrearDTO cliente){
         clienteService.crearCliente(cliente);
    }

    @PutMapping("/editar/{id}")
    public void actualizarCliente(@PathVariable Integer id, @RequestBody Cliente cliente){
        clienteService.editarCliente(id, cliente);
    }

    @DeleteMapping("/eliminar/{id}")
    public void eliminarCliente(@PathVariable Integer id){
         clienteService.eliminarCliente(id);
    }
}
