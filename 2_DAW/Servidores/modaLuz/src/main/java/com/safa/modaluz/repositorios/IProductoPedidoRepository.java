package com.safa.modaluz.repositorios;

import com.safa.modaluz.modelos.ProductoPedido;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface IProductoPedidoRepository extends JpaRepository<ProductoPedido, Integer> {
}
