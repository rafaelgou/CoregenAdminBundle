<?php

namespace Coregen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Coregen\AdminBundle\Entity\User;
use Coregen\AdminBundle\Form\UserType;

use Coregen\AdminGeneratorBundle\ORM\GeneratorController;
use Coregen\AdminBundle\Generator\User as Generator;
use Coregen\AdminBundle\Form\Model\User as UserModel;

/**
 * User controller.
 */
class UserController extends GeneratorController
{
    public function configure()
    {
        //$generator = $this->get('coregen.generator');
        $generator = new Generator();
        $this->loadGenerator($generator);
    }

    /**
     * Displays a form to create an entity.
     *
     * @return Response
     */
    public function newAction()
    {
        // Configuring the Generator Controller
        $this->configure();

        $formType = $this->generator->form->type;

        $user = new UserModel();
        $form   = $this->createForm(new $formType(), $user);

        return $this->render('CoregenAdminBundle:User:new.html.twig', array(
            'generator' => $this->generator,
            'form'      => $form->createView()
        ));

    }

    /**
     * Creates a entity from form data
     *
     * @return Response
     */
    public function createAction()
    {
        // Configuring the Generator Controller
        $this->configure();

        $entityClass = $this->generator->class;
        $formType = $this->generator->form->type;

        $user = new UserModel();
        $form = $this->createForm(new $formType(), $user);

        $request = $this->getRequest();


        $form->bindRequest($request);

        if ($form->isValid()) {

            $data = $form->getData();
            $user = $this->persistUser($data);

            if ($user) {
                $this->get('session')->setFlash('success', 'The item was created successfully.');
            } else {
                $this->get('session')->setFlash('error', 'An error ocurred while saving the item. Check the informed data.');
            }

            return $this->redirect($this->generateUrl($this->generator->route));
        }

        $this->get('session')->setFlash('error', 'An error ocurred while saving the item. Check the informed data.');

        return $this->render('CoregenAdminBundle:User:new.html.twig', array(
            'generator' => $this->generator,
//            'record'    => $entity,
            'form'      => $form->createView()
        ));

    }

    /**
     * Displays a form to edit an existing entity.
     *
     * @param integer $id The object id
     *
     * @return Response
     */
    public function editAction($id)
    {
        // Configuring the Generator Controller
        $this->configure();

        $entityClass = $this->generator->class;
        $formType = $this->generator->form->type;

        $manager = $this->getDoctrine()->getEntityManager();

        $entity = $manager->getRepository($this->generator->model)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Entity.');
        }

        $user = new UserModel();
        $user->username   = $entity->getUsername();
        $user->email      = $entity->getUsername();
        $user->enable     = $entity->isEnabled();
        $user->superAdmin = $entity->isSuperAdmin();
        $user->name       = $entity->getName();

        $form   = $this->createForm(new $formType(), $user);

        $editForm = $this->createForm(new $formType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        foreach ($this->generator->getHiddenFields('edit') as $fieldName) {
            $editForm->remove($fieldName);
        }

        return $this->render('CoregenAdminBundle:User:edit.html.twig', array(
            'generator'   => $this->generator,
            'record'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Update Action
     *
     * @param mixed $id Entity/Document Id
     *
     * @return Response
     */
    public function updateAction($id)
    {
        // Configuring the Generator Controller
        $this->configure();

        $manager = $this->getDoctrine()->getEntityManager();

        $entity = $manager->getRepository($this->generator->model)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        $formType = $this->generator->form->type;

        $user = new UserModel();
        $editForm = $this->createForm(new $formType(), $user);
        //$editForm = $this->createForm(new $formType(), $entity);

        $deleteForm = $this->createDeleteForm($id);

        foreach ($this->generator->getHiddenFields('edit') as $fieldName) {
            $editForm->remove($fieldName);
        }
        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            //$manager->persist($entity);
            //$manager->flush();
            $data = $editForm->getData();
            $user = $this->persistUser($data, $entity);

            $this->get('session')->setFlash('success', 'The item was updated successfully.');
            return $this->redirect($this->generateUrl($this->generator->route));
            //return $this->redirect($this->generateUrl($this->generator->route . '_show', array('id' => $id)));
        } else {
            $this->get('session')->setFlash('error', 'An error ocurred while saving the item. Check the informed data.');
            return $this->render('CoregenAdminBundle:User:edit.html.twig', array(
                'generator'   => $this->generator,
                'record'      => $entity,
                'form'        => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));

        }

    }

    /**
     * Persist User
     *
     * @param object $data The new data
     * @param User   $user The user object
     *
     * @return mixed
     */
    protected function persistUser($data, $user=null)
    {
        try {
            if (null === $user) {
                $user = $this->get('fos_user.user_manager')->createUser();
            }
            $user->setUsername($data->username);
            $user->setEmail($data->email);
            if ($data->password != '') {
                $user->setPlainPassword($data->password);
            }
            $user->setEnabled($data->enabled);
            $user->setLocked(false);
            $user->setSuperAdmin($data->superAdmin ? true : false);
            $user->setName($data->name);
            $this->get('fos_user.user_manager')->updateUser($user);
            return $user;
        } catch (Exception $exc) {
            return false;
        }

    }

}
