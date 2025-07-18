<?php

/**
 * This file is part of FPDI
 *
 * @package   setasign\Fpdi
 * @copyright Copyright (c) 2024 Setasign GmbH & Co. KG (https://www.setasign.com)
 * @license   http://opensource.org/licenses/mit-license The MIT License
 */

namespace setasign\Fpdi;

use setasign\Fpdi\PdfParser\CrossReference\CrossReferenceException;
use setasign\Fpdi\PdfParser\PdfParserException;
use setasign\Fpdi\PdfParser\Type\PdfIndirectObject;
use setasign\Fpdi\PdfParser\Type\PdfNull;

/**
 * Class Fpdi
 *
 * This class let you import pages of existing PDF documents into a reusable structure for FPDF.
 */
class Fpdi extends FpdfTpl
{
    use FpdiTrait;
    use FpdfTrait;

    /**
     * FPDI version
     *
     * @string
     */
    const VERSION = '2.6.3';

    
    function WriteHTML($html)
    {
        // Remove quebras de linha desnecessárias
        $html = str_replace("\n", ' ', $html);
        // Divide por tags
        $a = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                // Texto
                $this->Write(5, $e);
            } else {
                // Tag
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    // Extrair atributos
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $this->OpenTag($tag);
                }
            }
        }
    }

    function OpenTag($tag)
    {
        if ($tag == 'B')
            $this->SetFont('', 'B');
        if ($tag == 'BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        if ($tag == 'B')
            $this->SetFont('', '');
    }
}
