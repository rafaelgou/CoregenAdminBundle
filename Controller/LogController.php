<?php

namespace Coregen\AdminBundle\Controller;

use Coregen\AdminGeneratorBundle\ORM\GeneratorController;
use Coregen\AdminBundle\Generator\Log as Generator;

use Coregen\AdminBundle\Entity\Log;
use Coregen\AdminBundle\Form\LogFilterType;


/**
 * Log controller.
 *
 */
class LogController extends GeneratorController
{
    public function configure()
    {
        //$generator = $this->get('coregen.generator');
        $generator = new Generator();
        $this->loadGenerator($generator);
    }

//    public function indexAction()
//    {
//
//        // Configuring the Generator Controller
//        $this->configure();
//
//        // Defining filters
//        $this->configureFilter();
//
//        // Defining actual page
//        $this->setPage($this->getRequest()->get('page', $this->getPage()));
//
//        $filterForm = $this->createFilterForm();
//        if ($filterForm) {
//            $filterForm = $filterForm->createView();
//        }
//
//        $pager = $this->getPager();
//
//        return $this->render('CoregenAdminBundle:Log:index.html.twig', array(
//            'generator' => $this->generator,
//            'pager'     => $pager,
//            'filter_form' => $filterForm,
//        ));
//    }
//
//    /**
//     * Lists all Log entities.
//     *
//     */
//    public function index2Action()
//    {
//
//        $filterForm = $this->createForm(new LogFilterType());
//
//        $em = $this->getDoctrine()->getEntityManager();
//
//        $qb = $em->createQueryBuilder();
//        $qb->select('l')
//           ->from('CoregenAdminBundle:Log', 'l');
//
//        $request = $this->getRequest();
//
//        if ($request->get('logfiltertype', false))
//        {
//            $filterForm->bindRequest($request);
//
//            if ($filterForm->isValid())
//            {
//                $formData = $request->get('logfiltertype');
//
//                // user
//                if ($formData['user'] != '')
//                    $qb->andWhere($qb->expr()->eq('l.user', $formData['user']));
//
//                // type
//                if ($formData['type'] != '')
//                    $qb->andWhere($qb->expr()->eq('l.type', "'" . $formData['type'] . "'"));
//
//                // TODO
//                // created_at
////              if ($formData[''] != '')
////                    $qb->andWhere($qb->expr()->eq('l.type', $formData['type']));
////
//                // sort
//                $qb->orderBy('l.createdAt',$formData['sort']);
//
//            } else {
////                $formData = new LogFilterType();
////                $formData->
//
//                // sort default
//                $qb->orderBy('l.createdAt','ASC' );
//
//            }
//        }
//
//
//
//
//
//
//        $entities = $qb->getQuery()->getResult();
//
//        //$entities = $em->getRepository('CoregenAdminBundle:Log')->findAll();
//
//        return $this->render('CoregenAdminBundle:Log:index.html.twig', array(
//            'entities' => $entities,
//            'logFilterForm' => $filterForm->createView(),
//        ));
//    }
//
//    /**
//     * Finds and displays a Tarefa entity.
//     *
//     */
//    public function showAction($id)
//    {
//        // Configuring the Generator Controller
//        $this->configure();
//
//        $manager = $this->getDoctrine()->getEntityManager();
//
//        $entity = $manager->getRepository($this->generator->model)->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Entity.');
//        }
//
//        return $this->render('CoregenAdminBundle:Log:show.html.twig', array(
//            'generator' => $this->generator,
//            'record'      => $entity,
//        ));
//    }
//
//    /**
//     * Finds and displays a Log entity.
//     *
//     */
//    public function show2Action($id)
//    {
//        $em = $this->getDoctrine()->getEntityManager();
//
//        $entity = $em->getRepository('CoregenAdminBundle:Log')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Log entity.');
//        }
//
//        return $this->render('CoregenAdminBundle:Log:show.html.twig', array(
//            'entity'      => $entity,
//        ));
//    }

}
