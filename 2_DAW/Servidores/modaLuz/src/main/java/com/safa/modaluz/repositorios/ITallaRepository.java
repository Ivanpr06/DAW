package com.safa.modaluz.repositorios;

import com.safa.modaluz.modelos.Talla;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ITallaRepository extends JpaRepository<Talla, Integer> {
}
