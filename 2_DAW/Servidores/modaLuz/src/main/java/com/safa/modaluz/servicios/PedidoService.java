package com.safa.modaluz.servicios;

import com.safa.modaluz.dto.ClienteCrearDTO;
import com.safa.modaluz.dto.PedidoCrearDTO;
import com.safa.modaluz.modelos.Cliente;
import com.safa.modaluz.modelos.Pedido;
import com.safa.modaluz.repositorios.IClienteRepository;
import com.safa.modaluz.repositorios.IPedidoRepository;
import lombok.AllArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@AllArgsConstructor
public class PedidoService {

    private IPedidoRepository pedidoRepository;

    // Buscar Todos
    public List<Pedido> bucarTodosPedidos() {
        return pedidoRepository.findAll();
    }

    // Buscar por Id
    public Pedido buscarPedidoPorId(Integer id) {
        return pedidoRepository.findById(id).orElse(null);
    }

    // Editar
    public void editarPedido(Integer id, Pedido detallesCliente) {
        Pedido pedidoExistente = pedidoRepository.findById(id).orElse(null);

        pedidoExistente.setPrecio(detallesCliente.getPrecio());
        pedidoExistente.setFecha(detallesCliente.getFecha());
        pedidoExistente.setCliente(detallesCliente.getCliente());

        pedidoRepository.save(pedidoExistente);
    }

    // Crear
    public void crearPedido(PedidoCrearDTO pedido) {
        Pedido nuevoPedido = new Pedido();

        nuevoPedido.setPrecio(pedido.getPrecio());
        nuevoPedido.setFecha(pedido.getFecha());
        nuevoPedido.setCliente(pedido.getCliente());

        pedidoRepository.save(nuevoPedido);
    }

    // Eliminar
    public void eliminarPedido(Integer id) {
        pedidoRepository.deleteById(id);
    }
}
