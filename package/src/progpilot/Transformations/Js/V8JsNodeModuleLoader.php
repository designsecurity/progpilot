<?php

/**
 * Simple Node.js module loader for use with V8Js PHP extension
 *
 * This class understands Node.js' node_modules/ directory structure
 * and can require modules/files from there.
 *
 * @copyright 2015,2018 Stefan Siegl <stesie@brokenpipe.de>
 * @author Stefan Siegl <stesie@brokenpipe.de>
 * @package V8JsNodeModuleLoader
 */

 
namespace progpilot\Transformations\Js;

class V8JsNodeModuleLoader
{
    /**
     * Collection of override rules
     *
     * "from" identifiers are stored as keys to the array, associated
     * replacements are the array's values.
     *
     * @var string[]
     */
    private $overrides = array();
    
    public function __construct()
    {
    }

    public function normalisePath(array $parts)
    {
        $normalisedParts = array();
        array_walk($parts, function ($part) use (&$normalisedParts) {
            switch ($part) {
                case '..':
                    if (!empty($normalisedParts)) {
                        array_pop($normalisedParts);
                    }
                    break;
                case '.':
                    break;
                default:
                    array_push($normalisedParts, $part);
            }
        });
        return $normalisedParts;
    }
    
    /**
     * Normalisation handler, to be passed to V8Js
     *
     * @param string $base
     * @param string $module_name
     * @access public
     * @return string[]
     */
    public function normaliseIdentifier($base, $module_name)
    {
        if (isset($this->overrides[$module_name])) {
            $normalisedParts = $this->normalisePath(
                explode('/', $this->overrides[$module_name])
            );
            $moduleName = array_pop($normalisedParts);
            $normalisedPath = implode('/', $normalisedParts);

            return array($normalisedPath, $moduleName);
        }

        $baseParts = explode('/', $base);
        $parts = explode('/', $module_name);

        if ($parts[0] == '.' or $parts[0] == '..') {
            // relative path, prepend base path
            $parts = array_merge($baseParts, $parts);
            return $this->handleRelativeLoad($parts);
        } else {
            return $this->handleModuleLoad($baseParts, $parts);
        }
    }

    /**
     * Module loader, to be passed to V8Js
     *
     * @param string $moduleName
     * @access public
     * @return string|object
     */
    public function loadModule($moduleName)
    {
        $filePath = null;

        foreach (array('', '.js', '.json') as $extension) {
            if (file_exists(__DIR__.'/'.$moduleName.$extension)) {
                $filePath = __DIR__.'/'.$moduleName.$extension;
                break;
            }
        }

        if ($filePath === null) {
            throw new \Exception('File not found ('.$moduleName.'): '.$filePath);
        }

        $content = file_get_contents($filePath);

        if (substr($filePath, -5) === '.json') {
            $content = \json_decode($content);
        }

        return $content;
    }

    /**
     * Add a loader override rule
     *
     * This can be used to load a V8Js-specific module instead of one
     * shipped with e.g. a npm package.
     *
     * @param mixed $from
     * @param mixed $to
     * @access public
     */
    public function addOverride($from, $to)
    {
        $this->overrides[$from] = $to;
    }

    private function handleRelativeLoad(array $parts)
    {
        $normalisedParts = $this->normalisePath($parts);
        $normalisedId = implode('/', $normalisedParts);

        if (isset($this->overrides[$normalisedId])) {
            $normalisedParts = $this->normalisePath(
                explode('/', $this->overrides[$normalisedId])
            );
            $moduleName = array_pop($normalisedParts);
            $normalisedPath = implode('/', $normalisedParts);

            return array($normalisedPath, $moduleName);
        }

        $sourcePath = implode('/', $normalisedParts);

        if (file_exists(__DIR__.'/'.$sourcePath) ||
           file_exists(__DIR__.'/'.$sourcePath.'.js') ||
           file_exists(__DIR__.'/'.$sourcePath.'.json')) {
            $moduleName = array_pop($normalisedParts);
            $normalisedPath = implode('/', $normalisedParts);

            return array($normalisedPath, $moduleName);
        }

        throw new \Exception('File not found: '.$sourcePath);
    }

    private function handleModuleLoad(array $baseParts, array $parts)
    {
        $moduleName = array_shift($parts);

        $baseModules = array_keys($baseParts, 'node_modules');

        if (empty($baseModules)) {
            $moduleParts = array();
        } else {
            $moduleParts = array_slice($baseParts, 0, end($baseModules) + 2);
        }

        $moduleParts[] = 'node_modules';
        $moduleParts[] = $moduleName;

        $moduleDir = implode('/', $moduleParts);

        if (!file_exists(__DIR__.'/'.$moduleDir)) {
            throw new \Exception('Module not found: ' . $moduleName.' dir :'.__DIR__.'/'.$moduleDir);
        }

        $moduleDir .= '/';

        if (empty($parts)) {
            $packageJsonPath = $moduleDir.'package.json';

            if (!file_exists(__DIR__.'/'.$packageJsonPath)) {
                throw new \Exception('File not exists: '.__DIR__.'/'.$packageJsonPath);
            }

            $packageJson = json_decode(file_get_contents(__DIR__.'/'.$packageJsonPath));

            if (!isset($packageJson->main)) {
                throw new \Exception('package.json does not declare main');
            }

            $normalisedParts = $this->normalisePath(
                array_merge($moduleParts, explode('/', $packageJson->main))
            );
        } else {
            $normalisedParts = $this->normalisePath(
                array_merge($moduleParts, $parts)
            );
        }

        $moduleName = array_pop($normalisedParts);
        $normalisedPath = implode('/', $normalisedParts);

        if (substr($moduleName, -3) == '.js') {
            $moduleName = substr($moduleName, 0, -3);
        }

        return array($normalisedPath, $moduleName);
    }
}
