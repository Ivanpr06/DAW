package com.safa.modaluz.controladores;


import com.safa.modaluz.dto.InventarioCrearDTO;
import com.safa.modaluz.modelos.Inventario;
import com.safa.modaluz.servicios.InventarioService;
import lombok.AllArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
@RequestMapping("/inventario")
public class InventarioController {

    @Autowired
    private InventarioService inventarioService;

    @GetMapping("/all")
    public List<Inventario> obtenerInventarios(){
        return inventarioService.bucarTodosInventarios();
    }

    @GetMapping("/{id}")
    public Inventario obtenerInventarioPorId(@PathVariable int id){
        return inventarioService.buscarInventarioPorId(id);
    }

    @PostMapping("/post")
    public void crearInventario(@RequestBody InventarioCrearDTO cliente){
        inventarioService.crearInventario(cliente);
    }

    @PutMapping("/editar/{id}")
    public void actualizarInventario(@PathVariable Integer id, @RequestBody Inventario inventario){
        inventarioService.editarInventario(id, inventario);
    }

    @DeleteMapping("/eliminar/{id}")
    public void eliminarInventario(@PathVariable Integer id){
        inventarioService.eliminarInventario(id);
    }
}
