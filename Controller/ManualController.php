<?php

namespace Coregen\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ManualController extends Controller
{

    protected function getContent($path)
    {
        $base = $this->get('kernel')->getRootDir();
        $file = $base . '/manual/' . $path . '.md';
        return file_get_contents($file);
    }
    protected function markdownRender($path)
    {
        $markdown = $this->get('markdown.parser')->transform($this->getContent($path));
        return $this->render('CoregenAdminBundle:Manual:index.html.twig', array(
            'markdown' => $markdown
        ));
    }
    public function indexAction()
    {
        return $this->markdownRender('index');
    }

}
