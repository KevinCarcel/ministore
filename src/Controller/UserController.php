<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\RegisterType;
use App\Form\UserEditType;
use App\Form\UserPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/user',)]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/register', name: 'app_user_register', methods: ['GET', 'POST'])]
    public function register(Request $request, EntityManagerInterface $entityManager,UserPasswordHasherInterface $userPasswordHasher,): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
                );

            $this-> addFlash('success','Your account is created.');
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home.index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/register.html.twig', [
            'RegisterType'=> $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }
    
    #[Route('/edition/{id}', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserRepository $userRepository, EntityManagerInterface $manager, int $id, UserPasswordHasherInterface $hasher): Response
    {
        $user = $userRepository->findOneBy(['id'=>$id]);
        //verif si le user est connecté
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        //verif si le user connecté est le meme que nous avons recuperer
        if($this->getUser() !== $user) {
            return $this->redirectToRoute('app_user_edit');
        }
        //creation du formulaire
        $form = $this->createForm(UserEditType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success2','Les informations de votre compte ont bien été modifiées');

            return $this->redirectToRoute('home.index');
        }
        return $this->render('user/edit.html.twig', [
            'UserEditType'=>$form->createView(),
        ]);
    }
    #[Route('/mdp/{id}', name:'user_edit_password', methods: ['GET','POST'])]
    public function editPassword(UserRepository $userRepository, int $id, Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher) : Response
    {
        //récupération du user par son $id
        $user = $userRepository->findOneBy(['id'=>$id]);

        $form = $this->createForm(UserPasswordType::class, $user);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            if($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())){
                $user->setPassword($hasher->hashPassword($user, $form->getData()['NewPassword']));
            
            $manager->persist($user);
            $manager->flush();
            
            $this->addFlash('success','Le mot de passe à été modifié'
            );
            return $this->redirectToRoute('home.index');
        }else {
            $this->addFlash('warning','le mot de passe est incorrect');
        }
    }
        
        return $this->render('user/editpass.html.twig',[
            'UserPasswordType'=>$form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}