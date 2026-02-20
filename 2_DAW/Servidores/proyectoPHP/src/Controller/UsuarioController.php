<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class UsuarioController extends AbstractController
{
    #[Route('/registro', name: 'app_registro')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        if($request->isMethod('POST')) {

            $correo = $request->request->get('correo');
            $nombre = $request->request->get('nombre');

            $repositorio = $entityManager->getRepository(Usuario::class);

            $existeCorreo = $repositorio->findOneBy(['correo' => $correo]);
            $existeNombre = $repositorio->findOneBy(['nombre' => $nombre]);

            if ($existeCorreo) {
                $this->addFlash('error', 'Ese correo ya está registrado.');
                return $this->redirectToRoute('app_registro');
            }

            if ($existeNombre) {
                $this->addFlash('error', 'Ese nombre de usuario ya está en uso.');
                return $this->redirectToRoute('app_registro');
            }

            $nuevo_usuario = new Usuario();
            $nuevo_usuario->setNombre($nombre);
            $nuevo_usuario->setCorreo($correo);
            $nuevo_usuario->setRol(['ROLE_USER']);
            $contrasena_contenido = $request->request->get('contrasena');

            $hashedContrasena = $passwordHasher->hashPassword($nuevo_usuario, $contrasena_contenido);

            $nuevo_usuario->setContrasena($hashedContrasena);
            $entityManager->persist($nuevo_usuario);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('usuario/registro.html.twig', [
            'error' => $error,
        ]);
    }
}
