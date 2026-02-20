package com.safa.modaluz.controladores;

import com.safa.modaluz.dto.TallaCrearDTO;
import com.safa.modaluz.modelos.Talla;
import com.safa.modaluz.servicios.TallaService;
import lombok.AllArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@AllArgsConstructor
@RequestMapping("/talla")
public class TallaController {

    @Autowired
    private TallaService tallaService;

    @GetMapping("/all")
    public List<Talla> obtenerTallas(){
        return tallaService.bucarTodosTallas();
    }

    @GetMapping("/{id}")
    public Talla obtenerTallaPorId(@PathVariable int id){
        return tallaService.buscarTallaPorId(id);
    }

    @PostMapping("/post")
    public void crearTalla(@RequestBody TallaCrearDTO talla){
        tallaService.crearTalla(talla);
    }

    @PutMapping("/editar/{id}")
    public void actualizarTalla(@PathVariable Integer id, @RequestBody Talla talla){
        tallaService.editarTalla(id, talla);
    }

    @DeleteMapping("/eliminar/{id}")
    public void eliminarTalla(@PathVariable Integer id){
        tallaService.eliminarTalla(id);
    }
}
