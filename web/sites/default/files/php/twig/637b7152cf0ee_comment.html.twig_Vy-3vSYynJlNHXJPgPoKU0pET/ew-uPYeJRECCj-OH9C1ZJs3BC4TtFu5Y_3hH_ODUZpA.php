<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/contrib/zuvi/templates/content/comment.html.twig */
class __TwigTemplate_822fb068896e962f875c474b6e1f5576 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 67
        echo "
<article";
        // line 68
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [0 => "js-comment single-comment"], "method", false, false, true, 68), 68, $this->source), "html", null, true);
        echo ">
  ";
        // line 74
        echo "  ";
        if (($context["comment_user_pic"] ?? null)) {
            // line 75
            echo "    <header class=\"comment-user-picture\">
      ";
            // line 76
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["user_picture"] ?? null), 76, $this->source), "html", null, true);
            echo "
      <mark class=\"hidden\" data-comment-timestamp=\"";
            // line 77
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["new_indicator_timestamp"] ?? null), 77, $this->source), "html", null, true);
            echo "\"></mark>
    </header>
  ";
        }
        // line 80
        echo "
  <div class=\"single-comment-content-body\">
    ";
        // line 82
        if (($context["title"] ?? null)) {
            // line 83
            echo "      ";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 83, $this->source), "html", null, true);
            echo "
      <h3";
            // line 84
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", [0 => "single-comment-title"], "method", false, false, true, 84), 84, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 84, $this->source), "html", null, true);
            echo "</h3>
      ";
            // line 85
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 85, $this->source), "html", null, true);
            echo "
    ";
        }
        // line 87
        echo "
    <div class=\"single-comment-meta\">
      <span>";
        // line 89
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["author"] ?? null), 89, $this->source), "html", null, true);
        echo " ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["created"] ?? null), 89, $this->source), "html", null, true);
        echo "</span>
      ";
        // line 90
        if (($context["parent"] ?? null)) {
            // line 91
            echo "        <p class=\"visually-hidden\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["parent"] ?? null), 91, $this->source), "html", null, true);
            echo "</p>
      ";
        }
        // line 93
        echo "    </div> <!-- /.single-comment-meta -->

    <div";
        // line 95
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [0 => "single-comment-content"], "method", false, false, true, 95), 95, $this->source), "html", null, true);
        echo ">
      ";
        // line 96
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 96, $this->source), "html", null, true);
        echo "
    </div>
  </div> <!-- /.single-comment-content -->
</article>
";
    }

    public function getTemplateName()
    {
        return "themes/contrib/zuvi/templates/content/comment.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 96,  106 => 95,  102 => 93,  96 => 91,  94 => 90,  88 => 89,  84 => 87,  79 => 85,  73 => 84,  68 => 83,  66 => 82,  62 => 80,  56 => 77,  52 => 76,  49 => 75,  46 => 74,  42 => 68,  39 => 67,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/zuvi/templates/content/comment.html.twig", "D:\\xampp\\htdocs\\drupallatest\\web\\themes\\contrib\\zuvi\\templates\\content\\comment.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 74);
        static $filters = array("escape" => 68);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
