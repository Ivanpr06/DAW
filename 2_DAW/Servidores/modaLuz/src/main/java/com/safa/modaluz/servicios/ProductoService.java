package com.safa.modaluz.servicios;

import com.safa.modaluz.dto.ClienteCrearDTO;
import com.safa.modaluz.dto.ProductoCrearDTO;
import com.safa.modaluz.modelos.Cliente;
import com.safa.modaluz.modelos.Producto;
import com.safa.modaluz.repositorios.IClienteRepository;
import com.safa.modaluz.repositorios.IProductoRepository;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class ProductoService {

    private IProductoRepository productoRepository;

    // Buscar Todos
    public List<Producto> bucarTodosProductos() {
        return productoRepository.findAll();
    }

    // Buscar por Id
    public Producto buscarProductoPorId(Integer id) {
        return productoRepository.findById(id).orElse(null);
    }

    // Editar
    public void editarProducto(Integer id, Producto detallesProducto) {
        Producto productoExistente = productoRepository.findById(id).orElse(null);

        productoExistente.setNombre(detallesProducto.getNombre());
        productoExistente.setColor(detallesProducto.getColor());
        productoExistente.setPrecio(detallesProducto.getPrecio());
        productoExistente.setTipo(detallesProducto.getTipo());

        productoRepository.save(productoExistente);
    }

    // Crear
    public void crearProducto(ProductoCrearDTO cliente) {
        Producto nuevoProducto = new Producto();

        nuevoProducto.setNombre(cliente.getNombre());
        nuevoProducto.setColor(cliente.getColor());
        nuevoProducto.setPrecio(cliente.getPrecio());
        nuevoProducto.setTipo(cliente.getTipo());

        productoRepository.save(nuevoProducto);
    }

    // Eliminar
    public void eliminarProducto(Integer id) {
        productoRepository.deleteById(id);
    }
}
