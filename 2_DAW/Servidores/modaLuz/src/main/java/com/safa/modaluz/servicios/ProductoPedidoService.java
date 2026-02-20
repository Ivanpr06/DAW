package com.safa.modaluz.servicios;

import com.safa.modaluz.dto.ProductoPedidoCrearDTO;
import com.safa.modaluz.modelos.ProductoPedido;
import com.safa.modaluz.repositorios.IProductoPedidoRepository;
import lombok.AllArgsConstructor;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class ProductoPedidoService {

    @Autowired
    private IProductoPedidoRepository productopedidoRepository;

    // Buscar Todos
    public List<ProductoPedido> bucarTodosProductoPedidos() {
        return productopedidoRepository.findAll();
    }

    // Buscar por Id
    public ProductoPedido buscarProductoPedidoPorId(Integer id) {
        return productopedidoRepository.findById(id).orElse(null);
    }

    // Editar
    public void editarProductoPedido(Integer id, ProductoPedido detallesProductoPedido) {
        ProductoPedido productopedidoExistente = productopedidoRepository.findById(id).orElse(null);

        productopedidoExistente.setCantidad(detallesProductoPedido.getCantidad());
        productopedidoExistente.setPedido(detallesProductoPedido.getPedido());
        productopedidoExistente.setProducto(detallesProductoPedido.getProducto());
        productopedidoExistente.setTalla(detallesProductoPedido.getTalla());

        productopedidoRepository.save(productopedidoExistente);
    }

    // Crear
    public void crearProductoPedido(ProductoPedidoCrearDTO cliente) {
        ProductoPedido nuevoProductoPedido = new ProductoPedido();

        nuevoProductoPedido.setCantidad(cliente.getCantidad());
        nuevoProductoPedido.setPedido(cliente.getPedido());
        nuevoProductoPedido.setProducto(cliente.getProducto());
        nuevoProductoPedido.setTalla(cliente.getTalla());

        productopedidoRepository.save(nuevoProductoPedido);
    }

    // Eliminar
    public void eliminarProductoPedido(Integer id) {
        productopedidoRepository.deleteById(id);
    }
}
