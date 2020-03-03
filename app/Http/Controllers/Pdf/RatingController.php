<?php

namespace App\Http\Controllers\Pdf;

use App\Contracts\PrintableFactoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Team;
use App\Services\FileGenerators\Pdf;
use App\Support\Factories\Printable\PdfPrintableFactory;
use Illuminate\Http\Request;
use View;

class RatingController extends Controller
{
    /**
     * The pdf instance.
     *
     * @var Pdf
     */
    protected $pdf;

    /**
     * @var PrintableFactoryInterface
     */
    protected $printableFactory;

    public function __construct(Pdf $pdf, PdfPrintableFactory $printableFactory)
    {
        $this->pdf              = $pdf;
        $this->printableFactory = $printableFactory;
    }

    public function __invoke(Request $request, int $year, string $formNumber, string $suffix = '')
    {
        $rating = $this->getRating($year, (int) $formNumber, $suffix);

        $teams = $this->getAllActiveTeamsOfYear($year);

        $printableRating = $this->printableFactory->make('pdf.rating', $rating);
        $name            = 'RSW-' . $rating->year->label . '-formulier-' . $rating->number . $rating->suffix;
        $options         = [
            'orientation' => $rating->printview->view,
            'title'       => $name,
        ];

        if (in_array($rating->printview->view, ['portrait', 'landscape'], true) === false) {
            $options = [
                'orientation' => 'portrait',
            ];
        }

        $printableRating->addData('teams', $teams);

        return response($this->pdf->render($printableRating, $options))->withHeaders(
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => ($request->has('download')
                        ? 'attachment'
                        : 'inline')
                    . "; filename='rating-{$name}.pdf'",
            ]
        );
    }

    protected function getRating(int $year, int $formNumber, string $suffix)
    {
        return Rating::withFormNumber($formNumber, $suffix)
            ->inYear($year)
            ->with(['printView', 'year', 'ratingCategory', 'criteria', 'definitions', 'year'])
            ->firstOrFail();
    }

    protected function getAllActiveTeamsOfYear(int $year)
    {
        return Team::inYear($year)->where('is_active', true)->get();
    }
}
